<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class RoleFilter implements FilterInterface
{
    /**
     * Memeriksa apakah level user sesuai dengan argumen rute yang diizinkan
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        $userLevel = session()->get('level');

        // Jika rute memiliki batasan role (argumen tidak kosong)
        if ($arguments !== null) {
            // Cek apakah level user saat ini ada di dalam array role yang diizinkan
            if (!in_array($userLevel, $arguments)) {
                // Jika tidak berhak, arahkan ke dashboard masing-masing sesuai levelnya
                return redirect()->to('/dashboard')->with('error', 'Akses Ditolak! Anda tidak memiliki izin untuk membuka halaman tersebut.');
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Tidak ada tindakan khusus setelah request
    }
}