<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\CompanyModel;
use App\Models\HierarchyModel;
use App\Models\ReportMasterModel;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

class Admin extends BaseController
{
    public function index()
    {
        return view('admin/dashboard');
    }

    public function settingCompany()
    {
        $companyModel = new CompanyModel();
        $data['company'] = $companyModel->first();
        return view('admin/setting_company', $data);
    }

    public function saveCompany()
    {
        $companyModel = new CompanyModel();
        $id = $this->request->getPost('id');
        
        $data = [
            'nama_perusahaan' => $this->request->getPost('nama_perusahaan'),
            'alamat'          => $this->request->getPost('alamat'),
            'nama_pimpinan'   => $this->request->getPost('nama_pimpinan')
        ];

        $logo = $this->request->getFile('logo');
        if ($logo && $logo->isValid() && !$logo->hasMoved()) {
            $newName = $logo->getRandomName();
            $logo->move('uploads/profil', $newName);
            $data['logo'] = $newName;
        }

        if ($id) {
            $companyModel->update($id, $data);
        } else {
            $companyModel->insert($data);
        }

        return redirect()->back()->with('success', 'Profil perusahaan berhasil disimpan');
    }

    public function crudUser()
    {
        $userModel = new UserModel();
        $data['users'] = $userModel->findAll();
        return view('admin/crud_user', $data);
    }

    public function saveUser()
    {
        $userModel = new UserModel();
        $data = [
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'username'     => $this->request->getPost('username'),
            'level'        => $this->request->getPost('level'),
        ];
        
        if ($this->request->getPost('password')) {
            $data['password'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        }

        $foto = $this->request->getFile('foto');
        if ($foto && $foto->isValid() && !$foto->hasMoved()) {
            $newName = $foto->getRandomName();
            $foto->move('uploads/profil', $newName);
            $data['foto'] = $newName;
        }

        $id = $this->request->getPost('id');
        if ($id) {
            $userModel->update($id, $data);
        } else {
            $userModel->insert($data);
        }

        return redirect()->back()->with('success', 'Data user berhasil disimpan');
    }

    public function importExcel()
    {
        $file = $this->request->getFile('file_excel');
        if ($file && $file->isValid()) {
            $reader = new Xlsx();
            $spreadsheet = $reader->load($file->getTempName());
            $sheetData = $spreadsheet->getActiveSheet()->toArray();

            $userModel = new UserModel();
            foreach ($sheetData as $key => $row) {
                if ($key == 0) continue;
                $userModel->insert([
                    'nama_lengkap' => $row[0],
                    'username'     => $row[1],
                    'password'     => password_hash($row[2], PASSWORD_DEFAULT),
                    'level'        => $row[3],
                ]);
            }
            return redirect()->back()->with('success', 'Data user berhasil diimport');
        }
        return redirect()->back()->with('error', 'File tidak valid');
    }

    public function settingHierarchy()
    {
        $userModel = new UserModel();
        $hierarchyModel = new HierarchyModel();
        
        $data['pimpinan']   = $userModel->whereIn('level', ['PIMPINAN TINGGI', 'MANAGERIAL', 'SUPERVISOR', 'KEPALA UNIT'])->findAll();
        $data['bawahans']   = $userModel->whereIn('level', ['MANAGERIAL', 'SUPERVISOR', 'KEPALA UNIT', 'STAFF'])->findAll();
        $data['hierarchies'] = $hierarchyModel->findAll();

        return view('admin/setting_hierarchy', $data);
    }

    public function saveHierarchy()
    {
        $hierarchyModel = new HierarchyModel();
        $id_atasan = $this->request->getPost('id_atasan');
        $id_bawahans = $this->request->getPost('id_bawahan');

        $hierarchyModel->where('id_atasan', $id_atasan)->delete();

        if ($id_bawahans) {
            foreach ($id_bawahans as $id_bawahan) {
                $hierarchyModel->insert([
                    'id_atasan'  => $id_atasan,
                    'id_bawahan' => $id_bawahan
                ]);
            }
        }

        return redirect()->back()->with('success', 'Hierarki berhasil disimpan');
    }

    public function monitorReports()
    {
        $reportModel = new ReportMasterModel();
        $data['reports'] = $reportModel->findAll();
        return view('admin/monitor_reports', $data);
    }
}