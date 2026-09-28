<?php

namespace App\Models;

use CodeIgniter\Model;

class KategoriFashionModel extends Model
{
    protected $table            = 'kategori_fashion';
    protected $primaryKey       = 'id_kategori';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useTimestamps    = false;

    protected $allowedFields = [
        'nama_kategori',
        'deskripsi',
    ];

    protected $validationRules = [
        'nama_kategori' => 'required|min_length[3]|max_length[100]',
    ];
}