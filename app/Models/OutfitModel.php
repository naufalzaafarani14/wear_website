<?php

namespace App\Models;

use CodeIgniter\Model;

class OutfitModel extends Model
{
    protected $table         = 'outfit';
    protected $primaryKey    = 'id_outfit';
    protected $allowedFields = ['id_kategori', 'id_style', 'nama_outfit', 'gender', 'deskripsi', 'image_url', 'tips', 'budget', 'status', 'tags'];
    protected $useTimestamps = false;
}