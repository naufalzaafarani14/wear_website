<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PostinganPenggunaModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class ModerasiKontenController extends BaseController
{
    protected PostinganPenggunaModel $model;

    public function __construct()
    {
        $this->model = new PostinganPenggunaModel();
    }

    public function index(): string
    {
        $db = \Config\Database::connect();
        $status = $this->request->getGet('status');

        $sql = "
            SELECT pp.*, cp.nama_channel, p.nama_lengkap
            FROM postingan_pengguna pp
            LEFT JOIN channel_pengguna cp ON cp.id_channel = pp.id_channel
            LEFT JOIN pengguna p ON p.id_pengguna = cp.id_pengguna
        ";

        if (! empty($status)) {
            $sql .= " WHERE pp.status = " . $db->escape($status);
        }

        $sql .= " ORDER BY pp.created_at DESC";

        $data = [
            'pageTitle' => 'Moderasi Konten',
            'items'     => $db->query($sql)->getResultArray(),
            'status'    => $status,
            'jumlahMenunggu' => $this->model->where('status', 'Menunggu Review')->countAllResults(),
        ];

        return view('admin/moderasi-konten/index', $data);
    }

    public function detail(int $id): string
    {
        $db = \Config\Database::connect();

        $sql = "
            SELECT pp.*, cp.nama_channel, cp.bio, p.nama_lengkap, p.email,
                   o.nama_outfit
            FROM postingan_pengguna pp
            LEFT JOIN channel_pengguna cp ON cp.id_channel = pp.id_channel
            LEFT JOIN pengguna p ON p.id_pengguna = cp.id_pengguna
            LEFT JOIN outfit o ON o.id_outfit = pp.id_outfit
            WHERE pp.id_postingan = ?
        ";

        $item = $db->query($sql, [$id])->getRowArray();

        if (! $item) {
            throw PageNotFoundException::forPageNotFound();
        }

        $data = [
            'pageTitle' => 'Detail Postingan',
            'item'      => $item,
        ];

        return view('admin/moderasi-konten/detail', $data);
    }

    public function approve(int $id)
    {
        $item = $this->model->find($id);

        if (! $item) {
            throw PageNotFoundException::forPageNotFound();
        }

        $this->model->update($id, [
            'status'           => 'Published',
            'catatan_moderasi' => null,
        ]);

        return redirect()->to('/admin/moderasi-konten')->with('sukses', 'Postingan berhasil disetujui dan sekarang tayang.');
    }

    public function reject(int $id)
    {
        $item = $this->model->find($id);

        if (! $item) {
            throw PageNotFoundException::forPageNotFound();
        }

        $catatan = $this->request->getPost('catatan_moderasi');

        $this->model->update($id, [
            'status'           => 'Ditolak',
            'catatan_moderasi' => $catatan,
        ]);

        return redirect()->to('/admin/moderasi-konten')->with('sukses', 'Postingan berhasil ditolak.');
    }

    public function delete(int $id)
    {
        $item = $this->model->find($id);

        if (! $item) {
            throw PageNotFoundException::forPageNotFound();
        }

        $this->model->delete($id);

        return redirect()->to('/admin/moderasi-konten')->with('sukses', 'Postingan berhasil dihapus permanen.');
    }
}