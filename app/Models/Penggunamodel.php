<?php

namespace App\Models;

use CodeIgniter\Model;

class PenggunaModel extends Model
{
    protected $table            = 'pengguna';
    protected $primaryKey       = 'id_pengguna';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $useTimestamps    = false;

    protected $allowedFields = [
        'nama_lengkap',
        'email',
        'password',
        'role',
        'tanggal_daftar',
    ];

    // Ambil data pengguna berdasarkan email (dipakai saat login)
    public function cekEmail(string $email)
    {
        return $this->where('email', $email)->first();
    }
}