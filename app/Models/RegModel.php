<?php

namespace App\Models;

use CodeIgniter\Model;

class RegModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id_user';
    protected $returnType       = 'object';
    protected $allowedFields    = ['username', 'nik_name', 'name_user', 'email_user', 'password_user', 'jabatan_user', 'id_unit'];
    protected $useTimestamps    = true;
    protected $useSoftDeletes   = false;

    function getAll()
    {
        $builder = $this->db->table('unit');
        $builder->join('users', 'users.id_unit = unit.id_unit');
        $query = $builder->get();
        return $query->getResult();
    }
}
