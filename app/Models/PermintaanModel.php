<?php

namespace App\Models;

use CodeIgniter\Model;

class PermintaanModel extends Model
{
    protected $table            = 'pfi';
    protected $primaryKey       = 'id_pfi';
    protected $returnType       = 'object';
    protected $allowedFields    = ['tanggal_pfi', 'tanggal_revisi', 'no_pfi', 'prioritas', 'type', 'id_unit', 'pengguna', 'dept', 'alasan_kebutuhan', 'progres', 'catatan', 'nama_staff', 'nama_fat', 'nama_gm', 'nama_head', 'approve'];
    protected $useTimestamps    = true;
    protected $useSoftDeletes   = false;

    function getAll()
    {
        $builder = $this->db->table('unit');
        $builder->join('pfi', 'pfi.id_unit = unit.id_unit');
        $query = $builder->get();
        return $query->getResult();
    }
}
