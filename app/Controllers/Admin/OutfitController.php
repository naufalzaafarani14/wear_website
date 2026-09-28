<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\OutfitModel;
use App\Models\DetailOutfitModel;
use App\Models\OutfitOccasionModel;
use App\Models\OutfitWarnaModel;
use App\Models\WarnaModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class OutfitController extends BaseController
{
    protected OutfitModel $model;
    protected DetailOutfitModel $detailModel;
    protected OutfitOccasionModel $occasionModel;
    protected OutfitWarnaModel $warnaRelModel;
    protected WarnaModel $warnaModel;

    public function __construct()
    {
        $this->model         = new OutfitModel();
        $this->detailModel   = new DetailOutfitModel();
        $this->occasionModel = new OutfitOccasionModel();
        $this->warnaRelModel = new OutfitWarnaModel();
        $this->warnaModel    = new WarnaModel();
    }

    public function index(): string
    {
        $keyword = $this->request->getGet('q');
        $status  = $this->request->getGet('status');

        $db = \Config\Database::connect();

        $sql = "
            SELECT o.*, sty.nama_style,
                   COUNT(DISTINCT do.id_item) AS jumlah_item
            FROM outfit o
            LEFT JOIN style_fashion sty ON sty.id_style = o.id_style
            LEFT JOIN detail_outfit do ON do.id_outfit = o.id_outfit
            WHERE 1=1
        ";
        $params = [];

        if (! empty($keyword)) {
            $sql .= " AND o.nama_outfit LIKE ?";
            $params[] = '%' . $keyword . '%';
        }

        if (! empty($status)) {
            $sql .= " AND o.status = ?";
            $params[] = $status;
        }

        $sql .= " GROUP BY o.id_outfit ORDER BY o.nama_outfit ASC";

        $data = [
            'pageTitle' => 'Outfit',
            'items'     => $db->query($sql, $params)->getResultArray(),
            'keyword'   => $keyword,
            'status'    => $status,
        ];

        return view('admin/outfit/index', $data);
    }

    protected function getFormLookups(): array
    {
        $db = \Config\Database::connect();

        return [
            'styleList'    => $db->table('style_fashion')->orderBy('nama_style', 'ASC')->get()->getResultArray(),
            'warnaList'    => $this->warnaModel->orderBy('nama_warna', 'ASC')->findAll(),
            'occasionList' => $db->table('occasion')->orderBy('nama', 'ASC')->get()->getResultArray(),
            'itemList'     => $db->query("
                SELECT itf.id_item, itf.nama_item, sf.nama_subkategori
                FROM item_fashion itf
                LEFT JOIN subkategori_fashion sf ON sf.id_subkategori = itf.id_subkategori
                WHERE itf.status = 'Published'
                ORDER BY itf.nama_item ASC
            ")->getResultArray(),
        ];
    }

    public function create(): string
    {
        $data = array_merge($this->getFormLookups(), [
            'pageTitle'        => 'Tambah Outfit',
            'outfit'           => null,
            'selectedItem'     => [],
            'selectedOccasion' => [],
            'selectedWarna'    => [],
        ]);

        return view('admin/outfit/form', $data);
    }

    protected function validateItemCount(): bool
    {
        $items = $this->request->getPost('item') ?? [];

        return count($items) >= 2;
    }

    public function store()
    {
        $rules = [
            'nama_outfit' => 'required|min_length[2]|max_length[150]',
            'id_style'    => 'required|numeric',
            'gender'      => 'required|in_list[Pria,Wanita,Unisex]',
            'budget'      => 'permit_empty|numeric',
            'status'      => 'required|in_list[Draft,Published]',
            'tags'        => 'permit_empty|max_length[255]',
            'deskripsi'   => 'permit_empty',
            'tips'        => 'permit_empty',
            'gambar'      => 'permit_empty|max_size[gambar,2048]|is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png,image/webp]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        if (! $this->validateItemCount()) {
            return redirect()->back()->withInput()->with('errors', ['item' => 'Minimal 2 Item Fashion harus dipilih untuk membuat sebuah Outfit.']);
        }

        $imageUrl = null;
        $file     = $this->request->getFile('gambar');

        if ($file && $file->isValid() && ! $file->hasMoved()) {
            $uploadPath = FCPATH . 'assets/uploads/outfit';

            if (! is_dir($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            $newName = $file->getRandomName();
            $file->move($uploadPath, $newName);
            $imageUrl = 'assets/uploads/outfit/' . $newName;
        }

        $idOutfit = $this->model->insert([
            'id_kategori' => null,
            'id_style'    => $this->request->getPost('id_style'),
            'nama_outfit' => $this->request->getPost('nama_outfit'),
            'gender'      => $this->request->getPost('gender'),
            'deskripsi'   => $this->request->getPost('deskripsi'),
            'image_url'   => $imageUrl,
            'tips'        => $this->request->getPost('tips'),
            'budget'      => $this->request->getPost('budget') ?: null,
            'status'      => $this->request->getPost('status'),
            'tags'        => $this->request->getPost('tags'),
        ], true);

        $urutan = 1;
        foreach ($this->request->getPost('item') ?? [] as $idItem) {
            $this->detailModel->insert(['id_outfit' => $idOutfit, 'id_item' => $idItem, 'urutan' => $urutan++]);
        }

        foreach ($this->request->getPost('occasion') ?? [] as $idOccasion) {
            $this->occasionModel->insert(['id_outfit' => $idOutfit, 'id_occasion' => $idOccasion]);
        }

        foreach ($this->request->getPost('warna') ?? [] as $idWarna) {
            $this->warnaRelModel->insert(['id_outfit' => $idOutfit, 'id_warna' => $idWarna]);
        }

        return redirect()->to('/admin/outfit')->with('sukses', 'Outfit berhasil ditambahkan.');
    }

    public function edit(int $id): string
    {
        $outfit = $this->model->find($id);

        if (! $outfit) {
            throw PageNotFoundException::forPageNotFound();
        }

        $data = array_merge($this->getFormLookups(), [
            'pageTitle'        => 'Edit Outfit',
            'outfit'           => $outfit,
            'selectedItem'     => array_column($this->detailModel->where('id_outfit', $id)->orderBy('urutan', 'ASC')->findAll(), 'id_item'),
            'selectedOccasion' => array_column($this->occasionModel->where('id_outfit', $id)->findAll(), 'id_occasion'),
            'selectedWarna'    => array_column($this->warnaRelModel->where('id_outfit', $id)->findAll(), 'id_warna'),
        ]);

        return view('admin/outfit/form', $data);
    }

    public function update(int $id)
    {
        $outfit = $this->model->find($id);

        if (! $outfit) {
            throw PageNotFoundException::forPageNotFound();
        }

        $rules = [
            'nama_outfit' => 'required|min_length[2]|max_length[150]',
            'id_style'    => 'required|numeric',
            'gender'      => 'required|in_list[Pria,Wanita,Unisex]',
            'budget'      => 'permit_empty|numeric',
            'status'      => 'required|in_list[Draft,Published]',
            'tags'        => 'permit_empty|max_length[255]',
            'deskripsi'   => 'permit_empty',
            'tips'        => 'permit_empty',
            'gambar'      => 'permit_empty|max_size[gambar,2048]|is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png,image/webp]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        if (! $this->validateItemCount()) {
            return redirect()->back()->withInput()->with('errors', ['item' => 'Minimal 2 Item Fashion harus dipilih untuk membuat sebuah Outfit.']);
        }

        $data = [
            'id_style'  => $this->request->getPost('id_style'),
            'nama_outfit' => $this->request->getPost('nama_outfit'),
            'gender'    => $this->request->getPost('gender'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'tips'      => $this->request->getPost('tips'),
            'budget'    => $this->request->getPost('budget') ?: null,
            'status'    => $this->request->getPost('status'),
            'tags'      => $this->request->getPost('tags'),
        ];

        $file = $this->request->getFile('gambar');

        if ($file && $file->isValid() && ! $file->hasMoved()) {
            $uploadPath = FCPATH . 'assets/uploads/outfit';

            if (! is_dir($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            $newName = $file->getRandomName();
            $file->move($uploadPath, $newName);
            $data['image_url'] = 'assets/uploads/outfit/' . $newName;
        }

        $this->model->update($id, $data);

        $this->detailModel->where('id_outfit', $id)->delete();
        $urutan = 1;
        foreach ($this->request->getPost('item') ?? [] as $idItem) {
            $this->detailModel->insert(['id_outfit' => $id, 'id_item' => $idItem, 'urutan' => $urutan++]);
        }

        $this->occasionModel->where('id_outfit', $id)->delete();
        foreach ($this->request->getPost('occasion') ?? [] as $idOccasion) {
            $this->occasionModel->insert(['id_outfit' => $id, 'id_occasion' => $idOccasion]);
        }

        $this->warnaRelModel->where('id_outfit', $id)->delete();
        foreach ($this->request->getPost('warna') ?? [] as $idWarna) {
            $this->warnaRelModel->insert(['id_outfit' => $id, 'id_warna' => $idWarna]);
        }

        return redirect()->to('/admin/outfit')->with('sukses', 'Outfit berhasil diperbarui.');
    }

    public function delete(int $id)
    {
        $outfit = $this->model->find($id);

        if (! $outfit) {
            throw PageNotFoundException::forPageNotFound();
        }

        $this->detailModel->where('id_outfit', $id)->delete();
        $this->occasionModel->where('id_outfit', $id)->delete();
        $this->warnaRelModel->where('id_outfit', $id)->delete();
        $this->model->delete($id);

        return redirect()->to('/admin/outfit')->with('sukses', 'Outfit berhasil dihapus.');
    }
}