<?php

namespace App\Models;

use CodeIgniter\Model;

class ItemWarnaModel extends Model
{
    protected $table         = 'item_warna';
    protected $primaryKey    = 'id_item_warna';
    protected $allowedFields = ['id_item', 'id_warna'];
    protected $useTimestamps = false;
}