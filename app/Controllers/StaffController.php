<?php

namespace App\Controllers;

class StaffController extends BaseController
{
    public function dashboard()
    {
        // Menampilkan halaman dashboard staff
        // Data nama, level, dll sudah otomatis bisa diakses via session() di view
        return view('staff/dashboard');
    }
}