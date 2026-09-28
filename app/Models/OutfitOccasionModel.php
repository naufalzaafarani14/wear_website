<?php

namespace App\Models;

use CodeIgniter\Model;

class OutfitOccasionModel extends Model
{
    protected $table         = 'outfit_occasion';
    protected $primaryKey    = 'id_outfit_occasion';
    protected $allowedFields = ['id_outfit', 'id_occasion'];
    protected $useTimestamps = false;
}