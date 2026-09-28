<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\KontenFashionModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class ArtikelController extends BaseController
{
    protected KontenFashionModel $model;
    protected string $jenisKonten = 'Artikel';

    public function __construct()
    {
        $this->model = new KontenFashionModel();
    }

    public function index(): string
    {
        $keyword = $this->request->getGet('q');
        $status  = $this->request->getGet('status');

        $builder = $this->model->where('jenis_konten', $this->jenisKonten);

        if (! empty($keyword)) {
            $builder = $builder->like('judul', $keyword);
        }

        if (! empty($status)) {
            $builder = $builder->where('status', $status);
        }

        $data = [
            'pageTitle' => 'Majalah / Artikel',
            'items'     => $builder->orderBy('tanggal_dibuat', 'DESC')->findAll(),
            'keyword'   => $keyword,
            'status'    => $status,
        ];

        return view('admin/artikel/index', $data);
    }

    public function create(): string
    {
        $data = [
            'pageTitle' => 'Tambah Artikel',
            'item'      => null,
        ];

        return view('admin/artikel/form', $data);
    }

    public function store()
    {
        $rules = [
            'judul'     => 'required|min_length[3]|max_length[200]',
            'author'    => 'permit_empty|max_length[100]',
            'ringkasan' => 'permit_empty',
            'isi_konten'=> 'required',
            'tags'      => 'permit_empty|max_length[255]',
            'status'    => 'required|in_list[Draft,Published]',
            'gambar'    => 'permit_empty|max_size[gambar,2048]|is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png,image/webp]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $imageUrl = null;
        $file     = $this->request->getFile('gambar');

        if ($file && $file->isValid() && ! $file->hasMoved()) {
            $uploadPath = FCPATH . 'assets/uploads/artikel';

            if (! is_dir($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            $newName = $file->getRandomName();
            $file->move($uploadPath, $newName);
            $imageUrl = 'assets/uploads/artikel/' . $newName;
        }

        $this->model->insert([
            'judul'          => $this->request->getPost('judul'),
            'author'         => $this->request->getPost('author'),
            'ringkasan'      => $this->request->getPost('ringkasan'),
            'isi_konten'     => $this->request->getPost('isi_konten'),
            'tags'           => $this->request->getPost('tags'),
            'status'         => $this->request->getPost('status'),
            'image_url'      => $imageUrl,
            'jenis_konten'   => $this->jenisKonten,
            'tanggal_dibuat' => date('Y-m-d H:i:s'),
        ]);

        return redirect()->to('/admin/artikel')->with('sukses', 'Artikel berhasil ditambahkan.');
    }

    public function edit(int $id): string
    {
        $item = $this->model->where('jenis_konten', $this->jenisKonten)->find($id);

        if (! $item) {
            throw PageNotFoundException::forPageNotFound();
        }

        $data = [
            'pageTitle' => 'Edit Artikel',
            'item'      => $item,
        ];

        return view('admin/artikel/form', $data);
    }

    public function update(int $id)
    {
        $item = $this->model->where('jenis_konten', $this->jenisKonten)->find($id);

        if (! $item) {
            throw PageNotFoundException::forPageNotFound();
        }

        $rules = [
            'judul'     => 'required|min_length[3]|max_length[200]',
            'author'    => 'permit_empty|max_length[100]',
            'ringkasan' => 'permit_empty',
            'isi_konten'=> 'required',
            'tags'      => 'permit_empty|max_length[255]',
            'status'    => 'required|in_list[Draft,Published]',
            'gambar'    => 'permit_empty|max_size[gambar,2048]|is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png,image/webp]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'judul'     => $this->request->getPost('judul'),
            'author'    => $this->request->getPost('author'),
            'ringkasan' => $this->request->getPost('ringkasan'),
            'isi_konten'=> $this->request->getPost('isi_konten'),
            'tags'      => $this->request->getPost('tags'),
            'status'    => $this->request->getPost('status'),
        ];

        $file = $this->request->getFile('gambar');

        if ($file && $file->isValid() && ! $file->hasMoved()) {
            $uploadPath = FCPATH . 'assets/uploads/artikel';

            if (! is_dir($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            $newName = $file->getRandomName();
            $file->move($uploadPath, $newName);
            $data['image_url'] = 'assets/uploads/artikel/' . $newName;
        }

        $this->model->update($id, $data);

        return redirect()->to('/admin/artikel')->with('sukses', 'Artikel berhasil diperbarui.');
    }

    public function preview(int $id): string
    {
        $item = $this->model->where('jenis_konten', $this->jenisKonten)->find($id);

        if (! $item) {
            throw PageNotFoundException::forPageNotFound();
        }

        $data = [
            'pageTitle' => 'Preview: ' . $item['judul'],
            'item'      => $item,
        ];

        return view('admin/artikel/preview', $data);
    }

    public function delete(int $id)
    {
        $item = $this->model->where('jenis_konten', $this->jenisKonten)->find($id);

        if (! $item) {
            throw PageNotFoundException::forPageNotFound();
        }

        $this->model->delete($id);

        return redirect()->to('/admin/artikel')->with('sukses', 'Artikel berhasil dihapus.');
    }
}