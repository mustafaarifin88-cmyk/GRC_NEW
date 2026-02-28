<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\ReportMasterModel;

class Profile extends BaseController
{
    public function edit()
    {
        return view('shared/profile_edit');
    }

    public function update()
    {
        $userModel = new UserModel();
        $id = session()->get('id');
        $data = [];

        $password = $this->request->getPost('password');
        if (!empty($password)) {
            $data['password'] = password_hash($password, PASSWORD_DEFAULT);
        }

        $foto = $this->request->getFile('foto');
        if ($foto && $foto->isValid() && !$foto->hasMoved()) {
            $newName = $foto->getRandomName();
            $foto->move('uploads/profil', $newName);
            $data['foto'] = $newName;
            session()->set('foto', $newName);
        }

        if (!empty($data)) {
            $userModel->update($id, $data);
        }

        return redirect()->back()->with('success', 'Profil berhasil diperbarui');
    }

    public function tracking()
    {
        $reportModel = new ReportMasterModel();
        $data['reports'] = $reportModel->where('id_user_staff', session()->get('id'))->findAll();
        
        return view('shared/report_tracking', $data);
    }
}