<?php

namespace App\Models;

use CodeIgniter\Model;

class OccasionModel extends Model
{
    protected $table            = 'occasion';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['nama', 'deskripsi'];
    protected $useTimestamps    = true;
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
}
