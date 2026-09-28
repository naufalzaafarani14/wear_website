<?php

namespace App\Models;

use CodeIgniter\Model;

class ChannelPenggunaModel extends Model
{
    protected $table         = 'channel_pengguna';
    protected $primaryKey    = 'id_channel';
    protected $allowedFields = ['id_pengguna', 'nama_channel', 'bio', 'foto_profil', 'created_at'];
    protected $useTimestamps = false;
}