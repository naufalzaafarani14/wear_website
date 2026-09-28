<?php

namespace App\Models;

use CodeIgniter\Model;

class OutfitWarnaModel extends Model
{
    protected $table         = 'outfit_warna';
    protected $primaryKey    = 'id_outfit_warna';
    protected $allowedFields = ['id_outfit', 'id_warna'];
    protected $useTimestamps = false;
}