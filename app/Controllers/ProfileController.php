<?php

namespace App\Controllers;

use App\Models\UserModel;

class ProfileController extends BaseController
{
    public function index()
    {
        $model = new UserModel();
        $data['user'] = $model->find(session()->get('id'));
        return view('profile/edit_profile', $data);
    }

    public function update()
    {
        $model = new UserModel();
        $id = session()->get('id');
        $data = [];

        if ($this->request->getPost('password')) {
            $data['password'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        }

        $photo = $this->request->getFile('photo');
        if ($photo && $photo->isValid() && !$photo->hasMoved()) {
            $newName = $photo->getRandomName();
            $photo->move('uploads/profiles', $newName);
            $data['photo'] = $newName;
            session()->set('photo', $newName); 
        }

        if (!empty($data)) {
            $model->update($id, $data);
        }

        return redirect()->back()->with('success', 'Profil berhasil diperbarui.');
    }
}
