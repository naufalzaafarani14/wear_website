<?php

namespace App\Models;

use CodeIgniter\Model;

class BrandModel extends Model
{
    protected $table         = 'brand';
    protected $primaryKey    = 'id_brand';
    protected $allowedFields = ['nama_brand', 'deskripsi', 'logo_url', 'website_url', 'is_featured'];
    protected $useTimestamps = false;
}