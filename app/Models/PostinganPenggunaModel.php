<?php

namespace App\Models;

use CodeIgniter\Model;

class PostinganPenggunaModel extends Model
{
    protected $table         = 'postingan_pengguna';
    protected $primaryKey    = 'id_postingan';
    protected $allowedFields = ['id_channel', 'id_outfit', 'caption', 'media_url', 'tipe_media', 'status', 'catatan_moderasi', 'created_at'];
    protected $useTimestamps = false;
}