<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\OccasionModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class OccasionController extends BaseController
{
    protected OccasionModel $model;

    public function __construct()
    {
        $this->model = new OccasionModel();
    }

    public function index(): string
    {
        $data = [
            'pageTitle' => 'Occasion',
            'items'     => $this->model->orderBy('nama', 'ASC')->findAll(),
        ];

        return view('admin/occasion/index', $data);
    }

    public function create(): string
    {
        $data = [
            'pageTitle' => 'Tambah Occasion',
            'item'      => null,
        ];

        return view('admin/occasion/form', $data);
    }

    public function store()
    {
        $rules = [
            'nama'      => 'required|min_length[2]|max_length[100]',
            'deskripsi' => 'permit_empty',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->model->insert([
            'nama'      => $this->request->getPost('nama'),
            'deskripsi' => $this->request->getPost('deskripsi'),
        ]);

        return redirect()->to('/admin/occasion')->with('sukses', 'Occasion berhasil ditambahkan.');
    }

    public function edit(int $id): string
    {
        $item = $this->model->find($id);

        if (! $item) {
            throw PageNotFoundException::forPageNotFound();
        }

        $data = [
            'pageTitle' => 'Edit Occasion',
            'item'      => $item,
        ];

        return view('admin/occasion/form', $data);
    }

    public function update(int $id)
    {
        $item = $this->model->find($id);

        if (! $item) {
            throw PageNotFoundException::forPageNotFound();
        }

        $rules = [
            'nama'      => 'required|min_length[2]|max_length[100]',
            'deskripsi' => 'permit_empty',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->model->update($id, [
            'nama'      => $this->request->getPost('nama'),
            'deskripsi' => $this->request->getPost('deskripsi'),
        ]);

        return redirect()->to('/admin/occasion')->with('sukses', 'Occasion berhasil diperbarui.');
    }

    public function delete(int $id)
    {
        $item = $this->model->find($id);

        if (! $item) {
            throw PageNotFoundException::forPageNotFound();
        }

        $this->model->delete($id);

        return redirect()->to('/admin/occasion')->with('sukses', 'Occasion berhasil dihapus.');
    }
}
