<?php

namespace App\Models;

use CodeIgniter\Model;

class UnitModel extends Model
{
    protected $table            = 'unit';
    protected $primaryKey       = 'id_unit';
    protected $returnType       = 'object';
    protected $allowedFields    = ['nama_unit'];
    protected $useTimestamps    = true;
    protected $useSoftDeletes   = false;
}
