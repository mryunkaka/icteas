<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id_user';
    protected $returnType       = 'object';
    protected $allowedFields    = ['username', 'nik_name', 'name_user', 'email_user', 'password_user', 'jabatan_user', 'id_unit', 'status', 'ttd'];
    protected $useTimestamps    = true;
    protected $useSoftDeletes   = false;

    function getAll()
    {
        $builder = $this->db->table('users');
        $builder->join('unit', 'unit.id_unit = users.id_unit');
        $query = $builder->get();
        return $query->getResult();
    }
}
