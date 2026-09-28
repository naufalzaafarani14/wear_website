<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\BrandModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class BrandController extends BaseController
{
    protected BrandModel $model;

    public function __construct()
    {
        $this->model = new BrandModel();
    }

    public function index(): string
    {
        $data = [
            'pageTitle' => 'Brand',
            'items'     => $this->model->orderBy('nama_brand', 'ASC')->findAll(),
        ];

        return view('admin/brand/index', $data);
    }

    public function create(): string
    {
        $data = [
            'pageTitle' => 'Tambah Brand',
            'item'      => null,
        ];

        return view('admin/brand/form', $data);
    }

    public function store()
    {
        $rules = [
            'nama_brand'  => 'required|min_length[2]|max_length[150]',
            'deskripsi'   => 'permit_empty',
            'logo_url'    => 'permit_empty|max_length[255]',
            'website_url' => 'permit_empty|max_length[255]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->model->insert([
            'nama_brand'  => $this->request->getPost('nama_brand'),
            'deskripsi'   => $this->request->getPost('deskripsi'),
            'logo_url'    => $this->request->getPost('logo_url'),
            'website_url' => $this->request->getPost('website_url'),
            'is_featured' => $this->request->getPost('is_featured') ? 1 : 0,
        ]);

        return redirect()->to('/admin/brand')->with('sukses', 'Brand berhasil ditambahkan.');
    }

    public function edit(int $id): string
    {
        $item = $this->model->find($id);

        if (! $item) {
            throw PageNotFoundException::forPageNotFound();
        }

        $data = [
            'pageTitle' => 'Edit Brand',
            'item'      => $item,
        ];

        return view('admin/brand/form', $data);
    }

    public function update(int $id)
    {
        $item = $this->model->find($id);

        if (! $item) {
            throw PageNotFoundException::forPageNotFound();
        }

        $rules = [
            'nama_brand'  => 'required|min_length[2]|max_length[150]',
            'deskripsi'   => 'permit_empty',
            'logo_url'    => 'permit_empty|max_length[255]',
            'website_url' => 'permit_empty|max_length[255]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->model->update($id, [
            'nama_brand'  => $this->request->getPost('nama_brand'),
            'deskripsi'   => $this->request->getPost('deskripsi'),
            'logo_url'    => $this->request->getPost('logo_url'),
            'website_url' => $this->request->getPost('website_url'),
            'is_featured' => $this->request->getPost('is_featured') ? 1 : 0,
        ]);

        return redirect()->to('/admin/brand')->with('sukses', 'Brand berhasil diperbarui.');
    }

    public function delete(int $id)
    {
        $item = $this->model->find($id);

        if (! $item) {
            throw PageNotFoundException::forPageNotFound();
        }

        $this->model->delete($id);

        return redirect()->to('/admin/brand')->with('sukses', 'Brand berhasil dihapus.');
    }
}