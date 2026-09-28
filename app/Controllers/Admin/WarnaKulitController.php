<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\WarnaKulitModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class WarnaKulitController extends BaseController
{
    protected WarnaKulitModel $model;

    public function __construct()
    {
        $this->model = new WarnaKulitModel();
    }

    public function index(): string
    {
        $data = [
            'pageTitle' => 'Warna Kulit',
            'items'     => $this->model->orderBy('nama_warna_kulit', 'ASC')->findAll(),
        ];

        return view('admin/warna-kulit/index', $data);
    }

    public function create(): string
    {
        $data = [
            'pageTitle' => 'Tambah Warna Kulit',
            'item'      => null,
        ];

        return view('admin/warna-kulit/form', $data);
    }

    public function store()
    {
        $rules = [
            'nama_warna_kulit' => 'required|min_length[2]|max_length[50]',
            'deskripsi'        => 'permit_empty',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->model->insert([
            'nama_warna_kulit' => $this->request->getPost('nama_warna_kulit'),
            'deskripsi'        => $this->request->getPost('deskripsi'),
        ]);

        return redirect()->to('/admin/warna-kulit')->with('sukses', 'Warna kulit berhasil ditambahkan.');
    }

    public function edit(int $id): string
    {
        $item = $this->model->find($id);

        if (! $item) {
            throw PageNotFoundException::forPageNotFound();
        }

        $data = [
            'pageTitle' => 'Edit Warna Kulit',
            'item'      => $item,
        ];

        return view('admin/warna-kulit/form', $data);
    }

    public function update(int $id)
    {
        $item = $this->model->find($id);

        if (! $item) {
            throw PageNotFoundException::forPageNotFound();
        }

        $rules = [
            'nama_warna_kulit' => 'required|min_length[2]|max_length[50]',
            'deskripsi'        => 'permit_empty',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->model->update($id, [
            'nama_warna_kulit' => $this->request->getPost('nama_warna_kulit'),
            'deskripsi'        => $this->request->getPost('deskripsi'),
        ]);

        return redirect()->to('/admin/warna-kulit')->with('sukses', 'Warna kulit berhasil diperbarui.');
    }

    public function delete(int $id)
    {
        $item = $this->model->find($id);

        if (! $item) {
            throw PageNotFoundException::forPageNotFound();
        }

        $this->model->delete($id);

        return redirect()->to('/admin/warna-kulit')->with('sukses', 'Warna kulit berhasil dihapus.');
    }
}