<?php

namespace App\Models;

use CodeIgniter\Model;

class DowntimeModel extends Model
{
    protected $table            = 'downtime';
    protected $primaryKey       = 'id_downtime';
    protected $returnType       = 'object';
    protected $allowedFields    = ['id_unit', 'tanggal_input', 'down_awal', 'down_akhir', 'interval', 'keterangan'];
    protected $useTimestamps    = true;
    protected $useSoftDeletes   = false;

    function getAll()
    {
        $builder = $this->db->table('downtime');
        $builder->join('unit', 'unit.id_unit = downtime.id_unit');
        $query = $builder->get();
        return $query->getResult();
    }
}
