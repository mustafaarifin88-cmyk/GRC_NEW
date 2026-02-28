<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\ReportModel;
use App\Models\CompanyModel;
use App\Models\HierarchyModel;

class Admin extends BaseController
{
    public function index()
    {
        $userModel = new UserModel();
        $reportModel = new ReportModel();

        $data = [
            'total_users'      => $userModel->countAllResults(),
            'total_reports'    => $reportModel->countAllResults(),
            'reports_approved' => $reportModel->where('status_approval', 'APPROVED')->countAllResults(),
            'reports_rejected' => $reportModel->where('status_approval', 'REJECTED')->countAllResults(),
            'recent_reports'   => $reportModel->select('report_submissions.*, users.nama_lengkap as nama_pembuat')
                                              ->join('users', 'users.id = report_submissions.id_user_staff', 'left')
                                              ->orderBy('report_submissions.created_at', 'DESC')
                                              ->findAll(5)
        ];

        return view('admin/dashboard', $data);
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
        $id = $this->request->getPost('id') ?? 1; 

        $data = [
            'nama_perusahaan' => $this->request->getPost('nama_perusahaan'),
            'bidang_usaha'    => $this->request->getPost('bidang_usaha'),
            'email'           => $this->request->getPost('email'),
            'telepon'         => $this->request->getPost('telepon'),
            'alamat'          => $this->request->getPost('alamat'),
        ];

        $logo = $this->request->getFile('logo');
        if ($logo && $logo->isValid() && !$logo->hasMoved()) {
            $newName = $logo->getRandomName();
            $logo->move('uploads/company', $newName);
            $data['logo'] = $newName;
        }

        if ($companyModel->find($id)) {
            $companyModel->update($id, $data);
        } else {
            $companyModel->insert($data);
        }

        return redirect()->to(base_url('admin/setting-company'))->with('success', 'Profil Perusahaan berhasil diperbarui.');
    }

    public function crudUser()
    {
        $userModel = new UserModel();
        $data['users'] = $userModel->findAll();
        
        return view('admin/crud_user', $data);
    }

    public function storeUser()
    {
        $userModel = new UserModel();
        
        $data = [
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'username'     => $this->request->getPost('username'),
            'password'     => password_hash((string) $this->request->getPost('password'), PASSWORD_DEFAULT),
            'level'        => $this->request->getPost('level')
        ];

        $userModel->insert($data);
        return redirect()->to(base_url('admin/users'))->with('success', 'Pengguna berhasil ditambahkan.');
    }

    public function updateUser($id)
    {
        $userModel = new UserModel();
        
        $data = [
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'username'     => $this->request->getPost('username'),
            'level'        => $this->request->getPost('level')
        ];

        $password = $this->request->getPost('password');
        if (!empty($password)) {
            $data['password'] = password_hash((string) $password, PASSWORD_DEFAULT);
        }

        $userModel->update($id, $data);
        return redirect()->to(base_url('admin/users'))->with('success', 'Data pengguna berhasil diupdate.');
    }

    public function deleteUser($id)
    {
        $userModel = new UserModel();
        $userModel->delete($id);
        
        return redirect()->to(base_url('admin/users'))->with('success', 'Pengguna berhasil dihapus.');
    }

    public function importExcel()
    {
        return redirect()->to(base_url('admin/users'))->with('success', 'Fitur Import Excel akan segera tersedia.');
    }

    public function settingHierarchy()
    {
        $hierarchyModel = new HierarchyModel();
        $userModel = new UserModel();
        
        // PERBAIKAN: Ubah kata 'hierarchies' menjadi 'user_hierarchy' pada select() dan join()
        $data['hierarchies'] = $hierarchyModel->select('user_hierarchy.*, atasan.nama_lengkap as nama_atasan, atasan.level as level_atasan, bawahan.nama_lengkap as nama_bawahan, bawahan.level as level_bawahan')
                                              ->join('users as atasan', 'atasan.id = user_hierarchy.id_atasan')
                                              ->join('users as bawahan', 'bawahan.id = user_hierarchy.id_bawahan')
                                              ->findAll();
        $data['all_users'] = $userModel->findAll();

        return view('admin/setting_hierarchy', $data);
    }

    public function saveHierarchy()
    {
        $hierarchyModel = new HierarchyModel();
        
        $data = [
            'id_atasan'  => $this->request->getPost('id_atasan'),
            'id_bawahan' => $this->request->getPost('id_bawahan')
        ];

        $hierarchyModel->insert($data);
        return redirect()->to(base_url('admin/hierarchy'))->with('success', 'Relasi Hierarki berhasil ditambahkan.');
    }

    public function deleteHierarchy($id)
    {
        $hierarchyModel = new HierarchyModel();
        $hierarchyModel->delete($id);
        
        return redirect()->to(base_url('admin/hierarchy'))->with('success', 'Relasi Hierarki berhasil dihapus.');
    }

    public function monitorReports()
    {
        $reportModel = new ReportModel();
        
        $data['reports'] = $reportModel->select('report_submissions.*, users.nama_lengkap as nama_pembuat, users.foto as foto_pembuat')
                                       ->join('users', 'users.id = report_submissions.id_user_staff', 'left')
                                       ->orderBy('report_submissions.created_at', 'DESC')
                                       ->findAll();

        return view('admin/monitor_reports', $data);
    }
}