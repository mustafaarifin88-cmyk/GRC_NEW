<?php

namespace App\Controllers;

use App\Models\UserModel;

class AuthController extends BaseController
{
    public function login()
    {
        return view('auth/login');
    }

    public function processLogin()
    {
        $userModel = new UserModel();
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = $userModel->where('username', $username)->first();

        if ($user && password_verify($password, $user['password'])) {
            $sessionData = [
                'id'        => $user['id'],
                'username'  => $user['username'],
                'fullname'  => $user['fullname'],
                'level'     => $user['level'],
                'photo'     => $user['photo'],
                'logged_in' => true
            ];
            session()->set($sessionData);

            if ($user['level'] === 'ADMIN') return redirect()->to('/admin/dashboard');
            if ($user['level'] === 'STAFF') return redirect()->to('/staff/dashboard');
            return redirect()->to('/leader/dashboard');
        }

        return redirect()->back()->with('error', 'Username atau Password salah.');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
