<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function index()
    {
        if (session()->get('logged_in')) {
            return redirect()->to('/dashboard');
        }
        return view('auth/login');
    }

    public function login()
    {
        $userModel = new UserModel();
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = $userModel->where('username', $username)->first();

        if ($user && password_verify($password, $user['password'])) {
            session()->set([
                'id'           => $user['id'],
                'username'     => $user['username'],
                'nama_lengkap' => $user['nama_lengkap'],
                'level'        => $user['level'],
                'foto'         => $user['foto'],
                'logged_in'    => true
            ]);
            return redirect()->to('/dashboard');
        }

        return redirect()->back()->with('error', 'Username atau Password salah');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }

    public function dashboardDispatcher()
    {
        $level = session()->get('level');
        switch ($level) {
            case 'ADMIN':
                return redirect()->to('/admin/dashboard');
            case 'STAFF':
                return redirect()->to('/staff/dashboard');
            case 'KEPALA UNIT':
                return redirect()->to('/kepala-unit/dashboard');
            case 'SUPERVISOR':
                return redirect()->to('/supervisor/dashboard');
            case 'MANAGERIAL':
                return redirect()->to('/managerial/dashboard');
            case 'PIMPINAN TINGGI':
                return redirect()->to('/pimpinan-tinggi/dashboard');
            default:
                return redirect()->to('/logout');
        }
    }
}