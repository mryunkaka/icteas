<?php

namespace App\Models;

use CodeIgniter\Model;

class BakModel extends Model
{
    protected $table            = 'bak';
    protected $primaryKey       = 'id_bak';
    protected $returnType       = 'object';
    protected $allowedFields    = ['id_unit', 'no_bak', 'tanggal_bak', 'dilaporkan_oleh', 'dept_pelapor', 'jenis_barang', 'merk_tipe', 'no_aset', 'serial_number', 'pengguna_aset', 'uraian_kejadian', 'tindak_lanjut', 'bisa_diperbaiki', 'jabatan_pelapor', 'diketahui_oleh', 'nama_diketahui', 'jabatan_mengetahui', 'ditindaklanjuti', 'jabatan_ditindaklanjuti', 'jabatan_diketahui'];
    protected $useTimestamps    = true;
    protected $useSoftDeletes   = false;

    function getAll()
    {
        $builder = $this->db->table('unit');
        $builder->join('bak', 'bak.id_unit = unit.id_unit');
        $query = $builder->get();
        return $query->getResult();
    }
}
