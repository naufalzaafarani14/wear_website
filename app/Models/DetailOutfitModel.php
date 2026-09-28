<?php

namespace App\Models;

use CodeIgniter\Model;

class DetailOutfitModel extends Model
{
    protected $table         = 'detail_outfit';
    protected $primaryKey    = 'id_detail_outfit';
    protected $allowedFields = ['id_outfit', 'id_item', 'urutan'];
    protected $useTimestamps = false;
}