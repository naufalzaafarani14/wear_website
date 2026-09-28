<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\BentukTubuhModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class BentukTubuhController extends BaseController
{
    protected BentukTubuhModel $model;

    public function __construct()
    {
        $this->model = new BentukTubuhModel();
    }

    public function index(): string
    {
        $data = [
            'pageTitle' => 'Bentuk Tubuh',
            'items'     => $this->model->orderBy('nama_bentuk', 'ASC')->findAll(),
        ];

        return view('admin/bentuk-tubuh/index', $data);
    }

    public function create(): string
    {
        $data = [
            'pageTitle' => 'Tambah Bentuk Tubuh',
            'item'      => null,
        ];

        return view('admin/bentuk-tubuh/form', $data);
    }

    public function store()
    {
        $rules = [
            'nama_bentuk' => 'required|min_length[2]|max_length[50]',
            'deskripsi'   => 'permit_empty',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->model->insert([
            'nama_bentuk' => $this->request->getPost('nama_bentuk'),
            'deskripsi'   => $this->request->getPost('deskripsi'),
        ]);

        return redirect()->to('/admin/bentuk-tubuh')->with('sukses', 'Bentuk tubuh berhasil ditambahkan.');
    }

    public function edit(int $id): string
    {
        $item = $this->model->find($id);

        if (! $item) {
            throw PageNotFoundException::forPageNotFound();
        }

        $data = [
            'pageTitle' => 'Edit Bentuk Tubuh',
            'item'      => $item,
        ];

        return view('admin/bentuk-tubuh/form', $data);
    }

    public function update(int $id)
    {
        $item = $this->model->find($id);

        if (! $item) {
            throw PageNotFoundException::forPageNotFound();
        }

        $rules = [
            'nama_bentuk' => 'required|min_length[2]|max_length[50]',
            'deskripsi'   => 'permit_empty',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->model->update($id, [
            'nama_bentuk' => $this->request->getPost('nama_bentuk'),
            'deskripsi'   => $this->request->getPost('deskripsi'),
        ]);

        return redirect()->to('/admin/bentuk-tubuh')->with('sukses', 'Bentuk tubuh berhasil diperbarui.');
    }

    public function delete(int $id)
    {
        $item = $this->model->find($id);

        if (! $item) {
            throw PageNotFoundException::forPageNotFound();
        }

        $this->model->delete($id);

        return redirect()->to('/admin/bentuk-tubuh')->with('sukses', 'Bentuk tubuh berhasil dihapus.');
    }
}