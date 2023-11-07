<?php

namespace App\Models;

use CodeIgniter\Model;

class EmailModel extends Model
{
    protected $table            = 'email';
    protected $primaryKey       = 'id_email';
    protected $returnType       = 'object';
    protected $allowedFields    = ['id_email', 'no_email', 'tanggal_email', 'id_unit', 'nama_pemohon', 'jabatan_email', 'dept_email', 'opsi_email', 'pemohon_email', 'untuk_email', 'perangkat_user', 'akses_email', 'akses_keperluan', 'alamat_email', 'keterangan', 'nama_sect_head', 'nama_div_head', 'jabatan_sect_head', 'jabatan_div_head', 'div_hrga', 'div_ict', 'status'];
    protected $useTimestamps    = true;
    protected $useSoftDeletes   = false;

    function getAll()
    {
        $builder = $this->db->table('email');
        $builder->join('unit', 'unit.id_unit = email.id_unit');
        $query = $builder->get();
        return $query->getResult();
    }
}
