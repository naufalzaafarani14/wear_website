<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\SubkategoriFashionModel;
use App\Models\KategoriFashionModel;

class SubkategoriFashion extends BaseController
{
    protected $subkategoriModel;
    protected $kategoriModel;

    public function __construct()
    {
        $this->subkategoriModel = new SubkategoriFashionModel();
        $this->kategoriModel    = new KategoriFashionModel();
    }

    /**
     * GET /admin/subkategori-fashion
     */
    public function index()
    {
        $data = [
            'pageTitle'    => 'Kelola Subkategori Fashion',
            'subkategoris' => $this->subkategoriModel->getAllWithKategori(),
        ];

        return view('admin/subkategori_fashion/index', $data);
    }

    /**
     * GET /admin/subkategori-fashion/create
     */
    public function create()
    {
        $data = [
            'pageTitle' => 'Tambah Subkategori Fashion',
            'kategoris' => $this->kategoriModel->orderBy('nama_kategori', 'ASC')->findAll(),
        ];

        return view('admin/subkategori_fashion/create', $data);
    }

    /**
     * POST /admin/subkategori-fashion/store
     */
    public function store()
    {
        $data = [
            'id_kategori'      => $this->request->getPost('id_kategori'),
            'nama_subkategori' => $this->request->getPost('nama_subkategori'),
            'deskripsi'        => $this->request->getPost('deskripsi'),
        ];

        if (! $this->subkategoriModel->save($data)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->subkategoriModel->errors());
        }

        return redirect()->to('/admin/subkategori-fashion')
            ->with('sukses', 'Subkategori fashion berhasil ditambahkan.');
    }

    /**
     * GET /admin/subkategori-fashion/edit/{id}
     */
    public function edit($id)
    {
        $subkategori = $this->subkategoriModel->find($id);

        if (! $subkategori) {
            return redirect()->to('/admin/subkategori-fashion')
                ->with('gagal', 'Subkategori tidak ditemukan.');
        }

        $data = [
            'pageTitle'   => 'Edit Subkategori Fashion',
            'subkategori' => $subkategori,
            'kategoris'   => $this->kategoriModel->orderBy('nama_kategori', 'ASC')->findAll(),
        ];

        return view('admin/subkategori_fashion/edit', $data);
    }

    /**
     * POST /admin/subkategori-fashion/update/{id}
     */
    public function update($id)
    {
        $subkategori = $this->subkategoriModel->find($id);

        if (! $subkategori) {
            return redirect()->to('/admin/subkategori-fashion')
                ->with('gagal', 'Subkategori tidak ditemukan.');
        }

        $data = [
            'id_kategori'      => $this->request->getPost('id_kategori'),
            'nama_subkategori' => $this->request->getPost('nama_subkategori'),
            'deskripsi'        => $this->request->getPost('deskripsi'),
        ];

        if (! $this->subkategoriModel->update($id, $data)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->subkategoriModel->errors());
        }

        return redirect()->to('/admin/subkategori-fashion')
            ->with('sukses', 'Subkategori fashion berhasil diperbarui.');
    }

    /**
     * GET /admin/subkategori-fashion/delete/{id}
     */
    public function delete($id)
    {
        $subkategori = $this->subkategoriModel->find($id);

        if (! $subkategori) {
            return redirect()->to('/admin/subkategori-fashion')
                ->with('gagal', 'Subkategori tidak ditemukan.');
        }

        $this->subkategoriModel->delete($id);

        return redirect()->to('/admin/subkategori-fashion')
            ->with('sukses', 'Subkategori fashion berhasil dihapus.');
    }
}