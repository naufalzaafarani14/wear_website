<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PenggunaModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class PenggunaController extends BaseController
{
    protected PenggunaModel $model;

    public function __construct()
    {
        $this->model = new PenggunaModel();
    }

    public function index(): string
    {
        $keyword = $this->request->getGet('q');

        $builder = $this->model->select('id_pengguna, nama_lengkap, email, role, tanggal_daftar');

        if (! empty($keyword)) {
            $builder = $builder->groupStart()
                ->like('nama_lengkap', $keyword)
                ->orLike('email', $keyword)
                ->groupEnd();
        }

        $data = [
            'pageTitle' => 'Kelola Pengguna',
            'items'     => $builder->orderBy('tanggal_daftar', 'DESC')->findAll(),
            'keyword'   => $keyword,
        ];

        return view('admin/pengguna/index', $data);
    }

    public function detail(int $id): string
    {
        $user = $this->model->select('id_pengguna, nama_lengkap, email, role, tanggal_daftar')->find($id);

        if (! $user) {
            throw PageNotFoundException::forPageNotFound();
        }

        $db = \Config\Database::connect();

        $sql = "
            SELECT pr.*, bt.nama_bentuk, wk.nama_warna_kulit, sty.nama_style
            FROM profil_pengguna pr
            LEFT JOIN bentuk_tubuh bt ON bt.id_bentuk_tubuh = pr.id_bentuk_tubuh
            LEFT JOIN warna_kulit wk ON wk.id_warna_kulit = pr.id_warna_kulit
            LEFT JOIN style_fashion sty ON sty.id_style = pr.id_style
            WHERE pr.id_pengguna = ?
        ";

        $profil = $db->query($sql, [$id])->getRowArray();

        $data = [
            'pageTitle' => 'Detail Pengguna',
            'user'      => $user,
            'profil'    => $profil,
        ];

        return view('admin/pengguna/detail', $data);
    }

    public function updateRole(int $id)
    {
        $user = $this->model->find($id);

        if (! $user) {
            throw PageNotFoundException::forPageNotFound();
        }

        $rules = [
            'role' => 'required|in_list[user,admin]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->with('errors', $this->validator->getErrors());
        }

        $this->model->update($id, [
            'role' => $this->request->getPost('role'),
        ]);

        return redirect()->to('/admin/pengguna/detail/' . $id)->with('sukses', 'Role pengguna berhasil diperbarui.');
    }

    public function delete(int $id)
    {
        $user = $this->model->find($id);

        if (! $user) {
            throw PageNotFoundException::forPageNotFound();
        }

        $this->model->delete($id);

        return redirect()->to('/admin/pengguna')->with('sukses', 'Pengguna berhasil dihapus.');
    }
}