<?php

namespace App\Models;

use CodeIgniter\Model;

class WarnaModel extends Model
{
    protected $table         = 'warna';
    protected $primaryKey    = 'id_warna';
    protected $allowedFields = ['nama_warna', 'kode_hex'];
    protected $useTimestamps = false;
}