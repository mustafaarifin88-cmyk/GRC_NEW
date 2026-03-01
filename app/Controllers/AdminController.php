<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\CompanyProfileModel;
use App\Models\HierarchyModel;
use PhpOffice\PhpSpreadsheet\IOFactory;

class AdminController extends BaseController
{
    public function dashboard()
    {
        return view('admin/dashboard');
    }

    public function companyProfile()
    {
        $model = new CompanyProfileModel();
        $data['profile'] = $model->first();
        return view('admin/company_profile', $data);
    }

    public function updateCompanyProfile()
    {
        $model = new CompanyProfileModel();
        $id = $this->request->getPost('id');
        $data = [
            'company_name' => $this->request->getPost('company_name'),
            'address'      => $this->request->getPost('address'),
            'leader_name'  => $this->request->getPost('leader_name')
        ];

        $logo = $this->request->getFile('logo');
        if ($logo && $logo->isValid() && !$logo->hasMoved()) {
            $newName = $logo->getRandomName();
            $logo->move('uploads/company', $newName);
            $data['logo'] = $newName;
        }

        if ($id) {
            $model->update($id, $data);
        } else {
            $model->insert($data);
        }

        return redirect()->back()->with('success', 'Profil Perusahaan diperbarui.');
    }

    public function users()
    {
        $model = new UserModel();
        $data['users'] = $model->findAll();
        return view('admin/user_crud', $data);
    }

    public function saveUser()
    {
        $model = new UserModel();
        $data = [
            'fullname' => $this->request->getPost('fullname'),
            'username' => $this->request->getPost('username'),
            'level'    => $this->request->getPost('level'),
        ];

        if ($this->request->getPost('password')) {
            $data['password'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        }

        $photo = $this->request->getFile('photo');
        if ($photo && $photo->isValid() && !$photo->hasMoved()) {
            $newName = $photo->getRandomName();
            $photo->move('uploads/profiles', $newName);
            $data['photo'] = $newName;
        }

        $model->save($data);
        return redirect()->back()->with('success', 'User berhasil disimpan.');
    }

    public function importUsers()
    {
        $file = $this->request->getFile('excel_file');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $spreadsheet = IOFactory::load($file->getTempName());
            $sheet = $spreadsheet->getActiveSheet();
            $data = $sheet->toArray();
            
            $model = new UserModel();
            foreach ($data as $index => $row) {
                if ($index === 0) continue; 
                $model->insert([
                    'fullname' => $row[0],
                    'username' => $row[1],
                    'password' => password_hash($row[2], PASSWORD_DEFAULT),
                    'level'    => $row[3],
                ]);
            }
            return redirect()->back()->with('success', 'Data User berhasil diimport.');
        }
        return redirect()->back()->with('error', 'Gagal upload file.');
    }

    public function hierarchy()
    {
        $userModel = new UserModel();
        $data['leaders'] = $userModel->whereIn('level', ['PIMPINAN TINGGI', 'MANAGERIAL', 'SUPERVISOR', 'KEPALA UNIT'])->findAll();
        return view('admin/hierarchy_setting', $data);
    }

    public function reports()
    {
        return view('admin/report_monitoring');
    }
}
