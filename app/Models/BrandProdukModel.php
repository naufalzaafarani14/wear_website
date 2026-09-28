<?php

namespace App\Models;

use CodeIgniter\Model;

class BrandProdukModel extends Model
{
    protected $table         = 'brand_produk';
    protected $primaryKey    = 'id_produk';
    protected $allowedFields = ['id_brand', 'id_item', 'nama_produk', 'harga', 'link_produk', 'image_url'];
    protected $useTimestamps = false;
}