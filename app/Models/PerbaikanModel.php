<?php

namespace App\Models;

use CodeIgniter\Model;

class PerbaikanModel extends Model
{
    protected $table            = 'perbaikan';
    protected $primaryKey       = 'id_perbaikan';
    protected $returnType       = 'object';
    protected $allowedFields    = ['id_unit', 'no_perbaikan', 'tanggal_perbaikan', 'nama_pemohon', 'jabatan_pemohon', 'dept_pemohon', 'no_srf', 'jenis_barang', 'jb_lainnya', 'masalah', 'lainya', 'no_srf', 'masalah_kerusakan', 'diperiksa', 'jabatan_pemeriksa', 'disetujui', 'jabatan_menyetujui', 'diketahui', 'jabatan_mengetahui'];
    protected $useTimestamps    = true;
    protected $useSoftDeletes   = false;

    function getAll()
    {
        $builder = $this->db->table('unit');
        $builder->join('perbaikan', 'perbaikan.id_unit = unit.id_unit');
        $query = $builder->get();
        return $query->getResult();
    }
}
