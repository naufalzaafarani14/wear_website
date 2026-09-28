<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ItemFashionModel;
use App\Models\ItemWarnaModel;
use App\Models\ItemOccasionModel;
use App\Models\BrandProdukModel;
use App\Models\WarnaModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class ItemFashionController extends BaseController
{
    protected ItemFashionModel $model;
    protected ItemWarnaModel $itemWarnaModel;
    protected ItemOccasionModel $itemOccasionModel;
    protected BrandProdukModel $brandProdukModel;
    protected WarnaModel $warnaModel;

    public function __construct()
    {
        $this->model             = new ItemFashionModel();
        $this->itemWarnaModel    = new ItemWarnaModel();
        $this->itemOccasionModel = new ItemOccasionModel();
        $this->brandProdukModel  = new BrandProdukModel();
        $this->warnaModel        = new WarnaModel();
    }

    public function index(): string
    {
        $db = \Config\Database::connect();

        $sql = "
            SELECT itf.*, sf.nama_subkategori, sty.nama_style,
                   GROUP_CONCAT(DISTINCT w.nama_warna SEPARATOR ', ') AS daftar_warna,
                   GROUP_CONCAT(DISTINCT o.nama SEPARATOR ', ') AS daftar_occasion
            FROM item_fashion itf
            LEFT JOIN subkategori_fashion sf ON sf.id_subkategori = itf.id_subkategori
            LEFT JOIN style_fashion sty ON sty.id_style = itf.id_style
            LEFT JOIN item_warna iw ON iw.id_item = itf.id_item
            LEFT JOIN warna w ON w.id_warna = iw.id_warna
            LEFT JOIN item_occasion io ON io.id_item = itf.id_item
            LEFT JOIN occasion o ON o.id = io.id_occasion
            GROUP BY itf.id_item
            ORDER BY itf.nama_item ASC
        ";

        $data = [
            'pageTitle' => 'Item Fashion',
            'items'     => $db->query($sql)->getResultArray(),
        ];

        return view('admin/item-fashion/index', $data);
    }

    protected function getFormLookups(): array
    {
        $db = \Config\Database::connect();

        return [
            'subkategoriList' => $db->table('subkategori_fashion')->orderBy('nama_subkategori', 'ASC')->get()->getResultArray(),
            'styleList'       => $db->table('style_fashion')->orderBy('nama_style', 'ASC')->get()->getResultArray(),
            'warnaList'       => $this->warnaModel->orderBy('nama_warna', 'ASC')->findAll(),
            'occasionList'    => $db->table('occasion')->orderBy('nama', 'ASC')->get()->getResultArray(),
            'brandList'       => $db->table('brand')->orderBy('nama_brand', 'ASC')->get()->getResultArray(),
        ];
    }

    public function create(): string
    {
        $data = array_merge($this->getFormLookups(), [
            'pageTitle'        => 'Tambah Item Fashion',
            'item'             => null,
            'selectedWarna'    => [],
            'selectedOccasion' => [],
            'produk'           => null,
        ]);

        return view('admin/item-fashion/form', $data);
    }

    public function store()
    {
        $rules = [
            'nama_item'      => 'required|min_length[2]|max_length[150]',
            'id_subkategori' => 'required|numeric',
            'id_style'       => 'permit_empty|numeric',
            'jenis_item'     => 'permit_empty|max_length[50]',
            'gender'         => 'permit_empty|in_list[Pria,Wanita,Unisex]',
            'status'         => 'required|in_list[Draft,Published]',
            'tags'           => 'permit_empty|max_length[255]',
            'deskripsi'      => 'permit_empty',
            'gambar'         => 'permit_empty|max_size[gambar,2048]|is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png,image/webp]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $imageUrl = null;
        $file     = $this->request->getFile('gambar');

        if ($file && $file->isValid() && ! $file->hasMoved()) {
            $uploadPath = FCPATH . 'assets/uploads/item-fashion';

            if (! is_dir($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            $newName = $file->getRandomName();
            $file->move($uploadPath, $newName);
            $imageUrl = 'assets/uploads/item-fashion/' . $newName;
        }

        $idItem = $this->model->insert([
            'id_subkategori' => $this->request->getPost('id_subkategori'),
            'id_style'       => $this->request->getPost('id_style') ?: null,
            'nama_item'      => $this->request->getPost('nama_item'),
            'jenis_item'     => $this->request->getPost('jenis_item'),
            'deskripsi'      => $this->request->getPost('deskripsi'),
            'image_url'      => $imageUrl,
            'gender'         => $this->request->getPost('gender'),
            'status'         => $this->request->getPost('status'),
            'tags'           => $this->request->getPost('tags'),
        ], true);

        foreach ($this->request->getPost('warna') ?? [] as $idWarna) {
            $this->itemWarnaModel->insert(['id_item' => $idItem, 'id_warna' => $idWarna]);
        }

        foreach ($this->request->getPost('occasion') ?? [] as $idOccasion) {
            $this->itemOccasionModel->insert(['id_item' => $idItem, 'id_occasion' => $idOccasion]);
        }

        if ($this->request->getPost('id_brand')) {
            $this->brandProdukModel->insert([
                'id_brand'    => $this->request->getPost('id_brand'),
                'id_item'     => $idItem,
                'nama_produk' => $this->request->getPost('nama_item'),
                'harga'       => $this->request->getPost('harga') ?: null,
                'link_produk' => $this->request->getPost('link_produk'),
                'image_url'   => $imageUrl,
            ]);
        }

        return redirect()->to('/admin/item-fashion')->with('sukses', 'Item fashion berhasil ditambahkan.');
    }

    public function edit(int $id): string
    {
        $item = $this->model->find($id);

        if (! $item) {
            throw PageNotFoundException::forPageNotFound();
        }

        $produk = $this->brandProdukModel->where('id_item', $id)->first();

        $data = array_merge($this->getFormLookups(), [
            'pageTitle'        => 'Edit Item Fashion',
            'item'             => $item,
            'selectedWarna'    => array_column($this->itemWarnaModel->where('id_item', $id)->findAll(), 'id_warna'),
            'selectedOccasion' => array_column($this->itemOccasionModel->where('id_item', $id)->findAll(), 'id_occasion'),
            'produk'           => $produk,
        ]);

        return view('admin/item-fashion/form', $data);
    }

    public function update(int $id)
    {
        $item = $this->model->find($id);

        if (! $item) {
            throw PageNotFoundException::forPageNotFound();
        }

        $rules = [
            'nama_item'      => 'required|min_length[2]|max_length[150]',
            'id_subkategori' => 'required|numeric',
            'id_style'       => 'permit_empty|numeric',
            'jenis_item'     => 'permit_empty|max_length[50]',
            'gender'         => 'permit_empty|in_list[Pria,Wanita,Unisex]',
            'status'         => 'required|in_list[Draft,Published]',
            'tags'           => 'permit_empty|max_length[255]',
            'deskripsi'      => 'permit_empty',
            'gambar'         => 'permit_empty|max_size[gambar,2048]|is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png,image/webp]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'id_subkategori' => $this->request->getPost('id_subkategori'),
            'id_style'       => $this->request->getPost('id_style') ?: null,
            'nama_item'      => $this->request->getPost('nama_item'),
            'jenis_item'     => $this->request->getPost('jenis_item'),
            'deskripsi'      => $this->request->getPost('deskripsi'),
            'gender'         => $this->request->getPost('gender'),
            'status'         => $this->request->getPost('status'),
            'tags'           => $this->request->getPost('tags'),
        ];

        $file = $this->request->getFile('gambar');

        if ($file && $file->isValid() && ! $file->hasMoved()) {
            $uploadPath = FCPATH . 'assets/uploads/item-fashion';

            if (! is_dir($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            $newName = $file->getRandomName();
            $file->move($uploadPath, $newName);
            $data['image_url'] = 'assets/uploads/item-fashion/' . $newName;
        }

        $this->model->update($id, $data);

        $this->itemWarnaModel->where('id_item', $id)->delete();
        foreach ($this->request->getPost('warna') ?? [] as $idWarna) {
            $this->itemWarnaModel->insert(['id_item' => $id, 'id_warna' => $idWarna]);
        }

        $this->itemOccasionModel->where('id_item', $id)->delete();
        foreach ($this->request->getPost('occasion') ?? [] as $idOccasion) {
            $this->itemOccasionModel->insert(['id_item' => $id, 'id_occasion' => $idOccasion]);
        }

        $existingProduk = $this->brandProdukModel->where('id_item', $id)->first();

        if ($this->request->getPost('id_brand')) {
            $produkData = [
                'id_brand'    => $this->request->getPost('id_brand'),
                'id_item'     => $id,
                'nama_produk' => $this->request->getPost('nama_item'),
                'harga'       => $this->request->getPost('harga') ?: null,
                'link_produk' => $this->request->getPost('link_produk'),
            ];

            if ($existingProduk) {
                $this->brandProdukModel->update($existingProduk['id_produk'], $produkData);
            } else {
                $this->brandProdukModel->insert($produkData);
            }
        } elseif ($existingProduk) {
            $this->brandProdukModel->delete($existingProduk['id_produk']);
        }

        return redirect()->to('/admin/item-fashion')->with('sukses', 'Item fashion berhasil diperbarui.');
    }

    public function delete(int $id)
    {
        $item = $this->model->find($id);

        if (! $item) {
            throw PageNotFoundException::forPageNotFound();
        }

        $this->itemWarnaModel->where('id_item', $id)->delete();
        $this->itemOccasionModel->where('id_item', $id)->delete();
        $this->brandProdukModel->where('id_item', $id)->delete();
        $this->model->delete($id);

        return redirect()->to('/admin/item-fashion')->with('sukses', 'Item fashion berhasil dihapus.');
    }
}