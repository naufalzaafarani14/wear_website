<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\WarnaModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class WarnaController extends BaseController
{
    protected WarnaModel $model;

    public function __construct()
    {
        $this->model = new WarnaModel();
    }

    public function index(): string
    {
        $data = [
            'pageTitle' => 'Warna',
            'items'     => $this->model->orderBy('nama_warna', 'ASC')->findAll(),
        ];

        return view('admin/warna/index', $data);
    }

    public function create(): string
    {
        $data = [
            'pageTitle' => 'Tambah Warna',
            'item'      => null,
        ];

        return view('admin/warna/form', $data);
    }

    public function store()
    {
        $rules = [
            'nama_warna' => 'required|min_length[2]|max_length[50]',
            'kode_hex'   => 'permit_empty|max_length[10]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->model->insert([
            'nama_warna' => $this->request->getPost('nama_warna'),
            'kode_hex'   => $this->request->getPost('kode_hex'),
        ]);

        return redirect()->to('/admin/warna')->with('sukses', 'Warna berhasil ditambahkan.');
    }

    public function edit(int $id): string
    {
        $item = $this->model->find($id);

        if (! $item) {
            throw PageNotFoundException::forPageNotFound();
        }

        $data = [
            'pageTitle' => 'Edit Warna',
            'item'      => $item,
        ];

        return view('admin/warna/form', $data);
    }

    public function update(int $id)
    {
        $item = $this->model->find($id);

        if (! $item) {
            throw PageNotFoundException::forPageNotFound();
        }

        $rules = [
            'nama_warna' => 'required|min_length[2]|max_length[50]',
            'kode_hex'   => 'permit_empty|max_length[10]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->model->update($id, [
            'nama_warna' => $this->request->getPost('nama_warna'),
            'kode_hex'   => $this->request->getPost('kode_hex'),
        ]);

        return redirect()->to('/admin/warna')->with('sukses', 'Warna berhasil diperbarui.');
    }

    public function delete(int $id)
    {
        $item = $this->model->find($id);

        if (! $item) {
            throw PageNotFoundException::forPageNotFound();
        }

        $this->model->delete($id);

        return redirect()->to('/admin/warna')->with('sukses', 'Warna berhasil dihapus.');
    }
}