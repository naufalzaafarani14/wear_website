<?php

namespace App\Models;

use CodeIgniter\Model;

class BentukTubuhModel extends Model
{
    protected $table         = 'bentuk_tubuh';
    protected $primaryKey    = 'id_bentuk_tubuh';
    protected $allowedFields = ['nama_bentuk', 'deskripsi'];
    protected $useTimestamps = false;
}