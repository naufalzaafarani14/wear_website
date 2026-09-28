<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AdminFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Harus login dulu
        if (! session()->get('logged_in')) {
            return redirect()->to('/login')->with('gagal', 'Silakan login terlebih dahulu.');
        }

        // Harus role admin
        if (session()->get('role') !== 'admin') {
            return redirect()->to('/dashboard')->with('gagal', 'Kamu tidak punya akses ke halaman admin.');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // tidak ada aksi setelah request
    }
}