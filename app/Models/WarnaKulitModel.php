<?php

namespace App\Models;

use CodeIgniter\Model;

class WarnaKulitModel extends Model
{
    protected $table         = 'warna_kulit';
    protected $primaryKey    = 'id_warna_kulit';
    protected $allowedFields = ['nama_warna_kulit', 'deskripsi'];
    protected $useTimestamps = false;
}