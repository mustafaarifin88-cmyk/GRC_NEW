<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class RoleFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $userLevel = session()->get('level');

        if ($arguments !== null) {
            if (!in_array($userLevel, $arguments)) {
                return redirect()->to('/dashboard')->with('error', 'Akses Ditolak! Anda tidak memiliki izin untuk membuka halaman tersebut.');
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
    }
}