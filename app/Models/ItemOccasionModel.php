<?php

namespace App\Models;

use CodeIgniter\Model;

class ItemOccasionModel extends Model
{
    protected $table         = 'item_occasion';
    protected $primaryKey    = 'id_item_occasion';
    protected $allowedFields = ['id_item', 'id_occasion'];
    protected $useTimestamps = false;
}