<?php

namespace App\Models;

use CodeIgniter\Model;

class ProjectModel extends Model
{
    protected $table            = 'project';
    protected $primaryKey       = 'id_project';
    protected $returnType       = 'object';
    protected $allowedFields    = ['id_unit', 'no_ict', 'nama_project', 'jenis_pekerjaan', 'estimasi', 'rab', 'bapp', 'bast', 'status'];
    protected $useTimestamps    = true;
    protected $useSoftDeletes   = false;

    function getAll()
    {
        $builder = $this->db->table('unit');
        $builder->join('project', 'project.id_unit = unit.id_unit');
        $query = $builder->get();
        return $query->getResult();
    }
}
