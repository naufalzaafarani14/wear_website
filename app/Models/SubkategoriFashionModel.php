<?php

namespace App\Models;

use CodeIgniter\Model;

class SubkategoriFashionModel extends Model
{
    protected $table            = 'subkategori_fashion';
    protected $primaryKey       = 'id_subkategori';
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $useTimestamps    = false;

    protected $allowedFields = [
        'id_kategori',
        'nama_subkategori',
        'deskripsi',
    ];

    protected $validationRules = [
        'id_kategori'       => 'required|is_natural_no_zero',
        'nama_subkategori'  => 'required|min_length[3]|max_length[100]',
        'deskripsi'         => 'permit_empty',
    ];

    protected $validationMessages = [
        'id_kategori' => [
            'required'          => 'Kategori fashion wajib dipilih.',
            'is_natural_no_zero'=> 'Kategori fashion tidak valid.',
        ],
        'nama_subkategori' => [
            'required'   => 'Nama subkategori wajib diisi.',
            'min_length' => 'Nama subkategori minimal 3 karakter.',
            'max_length' => 'Nama subkategori maksimal 100 karakter.',
        ],
    ];

    /**
     * Ambil semua subkategori beserta nama kategori induknya (JOIN),
     * supaya tabel di halaman index tidak perlu query berulang.
     */
    public function getAllWithKategori()
    {
        return $this->select('subkategori_fashion.*, kategori_fashion.nama_kategori')
            ->join('kategori_fashion', 'kategori_fashion.id_kategori = subkategori_fashion.id_kategori')
            ->orderBy('subkategori_fashion.id_subkategori', 'ASC')
            ->findAll();
    }

    /**
     * Ambil satu subkategori beserta nama kategori induknya (untuk form edit).
     */
    public function getWithKategori($id)
    {
        return $this->select('subkategori_fashion.*, kategori_fashion.nama_kategori')
            ->join('kategori_fashion', 'kategori_fashion.id_kategori = subkategori_fashion.id_kategori')
            ->where('subkategori_fashion.id_subkategori', $id)
            ->first();
    }
}