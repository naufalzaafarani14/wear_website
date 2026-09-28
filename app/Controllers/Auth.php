<?php

namespace App\Controllers;

use App\Models\PenggunaModel;

class Auth extends BaseController
{
    protected PenggunaModel $penggunaModel;

    public function __construct()
    {
        $this->penggunaModel = new PenggunaModel();
    }

    // ================= REGISTER =================

    public function register()
    {
        return view('auth/register');
    }

    public function prosesRegister()
    {
        $rules = [
            'nama_lengkap'         => 'required|min_length[3]|max_length[150]',
            'email'                => 'required|valid_email|is_unique[pengguna.email]',
            'password'             => 'required|min_length[6]',
            'konfirmasi_password'  => 'required|matches[password]',
        ];

        $messages = [
            'email' => [
                'is_unique' => 'Email sudah terdaftar, silakan gunakan email lain.',
            ],
            'konfirmasi_password' => [
                'matches' => 'Konfirmasi password tidak sama dengan password.',
            ],
        ];

        if (! $this->validate($rules, $messages)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'nama_lengkap'   => $this->request->getPost('nama_lengkap'),
            'email'          => $this->request->getPost('email'),
            'password'       => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role'           => 'user',
            'tanggal_daftar' => date('Y-m-d H:i:s'),
        ];

        $this->penggunaModel->insert($data);

        return redirect()->to('/login')->with('sukses', 'Registrasi berhasil, silakan login.');
    }

    // ================= LOGIN =================

    public function login()
    {
        return view('auth/login');
    }

    public function prosesLogin()
    {
        $rules = [
            'email'    => 'required|valid_email',
            'password' => 'required',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $email    = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $this->penggunaModel->cekEmail($email);

        if (! $user) {
            return redirect()->back()->withInput()->with('gagal', 'Email belum terdaftar.');
        }

        if (! password_verify($password, $user['password'])) {
            return redirect()->back()->withInput()->with('gagal', 'Password salah.');
        }

        session()->set([
            'id_pengguna'  => $user['id_pengguna'],
            'nama_lengkap' => $user['nama_lengkap'],
            'email'        => $user['email'],
            'role'         => $user['role'],
            'logged_in'    => true,
        ]);

        if ($user['role'] === 'admin') {
            return redirect()->to('/admin');
        }

        return redirect()->to('/dashboard');
    }

    // ================= LOGOUT =================

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login')->with('sukses', 'Anda berhasil logout.');
    }

    // ================= DASHBOARD (contoh halaman terproteksi) =================

    public function dashboard()
    {
        return view('auth/dashboard');
    }
}