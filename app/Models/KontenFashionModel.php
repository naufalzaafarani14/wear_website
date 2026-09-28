<?php

namespace App\Models;

use CodeIgniter\Model;

class KontenFashionModel extends Model
{
    protected $table         = 'konten_fashion';
    protected $primaryKey    = 'id_konten';
    protected $allowedFields = ['id_kategori', 'judul', 'isi_konten', 'image_url', 'jenis_konten', 'tanggal_dibuat', 'author', 'ringkasan', 'status', 'tags', 'daerah_asal'];
    protected $useTimestamps = false;
}