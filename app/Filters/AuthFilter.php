<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface
{
    /**
     * Memeriksa apakah user sudah login sebelum mengakses rute
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        // Jika session 'logged_in' tidak ada atau false, lempar kembali ke halaman login
        if (!session()->get('logged_in')) {
            return redirect()->to('/')->with('error', 'Silakan login terlebih dahulu untuk mengakses sistem.');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Tidak ada tindakan khusus setelah request untuk Auth
    }
}