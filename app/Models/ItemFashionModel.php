<?php

namespace App\Models;

use CodeIgniter\Model;

class ItemFashionModel extends Model
{
    protected $table         = 'item_fashion';
    protected $primaryKey    = 'id_item';
    protected $allowedFields = ['id_subkategori', 'id_style', 'nama_item', 'jenis_item', 'deskripsi', 'image_url', 'gender', 'status', 'tags'];
    protected $useTimestamps = false;
}