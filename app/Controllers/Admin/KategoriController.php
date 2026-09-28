<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\KategoriFashionModel;

class KategoriController extends BaseController
{
    protected KategoriFashionModel $kategoriModel;

    public function __construct()
    {
        $this->kategoriModel = new KategoriFashionModel();
    }

    // Tampilkan semua kategori
    public function index(): string
    {
        $data = [
            'kategori' => $this->kategoriModel->orderBy('id_kategori', 'DESC')->findAll(),
        ];

        return view('admin/kategori/index', $data);
    }

    // Form tambah kategori baru
    public function create(): string
    {
        return view('admin/kategori/form');
    }

    // Simpan kategori baru
    public function store()
    {
        $rules = [
            'nama_kategori' => 'required|min_length[3]|max_length[100]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->kategoriModel->insert([
            'nama_kategori' => $this->request->getPost('nama_kategori'),
            'deskripsi'     => $this->request->getPost('deskripsi'),
        ]);

        return redirect()->to('/admin/kategori')->with('sukses', 'Kategori berhasil ditambahkan.');
    }

    // Form edit kategori
    public function edit(int $id): string
    {
        $data = [
            'data' => $this->kategoriModel->find($id),
        ];

        return view('admin/kategori/form', $data);
    }

    // Simpan perubahan kategori
    public function update(int $id)
    {
        $rules = [
            'nama_kategori' => 'required|min_length[3]|max_length[100]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->kategoriModel->update($id, [
            'nama_kategori' => $this->request->getPost('nama_kategori'),
            'deskripsi'     => $this->request->getPost('deskripsi'),
        ]);

        return redirect()->to('/admin/kategori')->with('sukses', 'Kategori berhasil diperbarui.');
    }

    // Hapus kategori
    public function delete(int $id)
    {
        $this->kategoriModel->delete($id);

        return redirect()->to('/admin/kategori')->with('sukses', 'Kategori berhasil dihapus.');
    }
}