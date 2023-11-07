<?php

namespace App\Models;

use CodeIgniter\Model;

class AsetModel extends Model
{
    protected $table            = 'aset';
    protected $primaryKey       = 'id_aset';
    protected $returnType       = 'object';
    protected $allowedFields    = ['id_unit', 'form_bast', 'no_aset', 'desc_aset', 'lokasi', 'user', 'foto_aset', 'tahun_perolehan', 'usia'];
    protected $useTimestamps    = true;
    protected $useSoftDeletes   = false;

    function getAll()
    {
        $builder = $this->db->table('unit');
        $builder->join('aset', 'aset.id_unit = unit.id_unit');
        $query = $builder->get();
        return $query->getResult();
    }
}
