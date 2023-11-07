<?php

namespace App\Models;

use CodeIgniter\Model;

class BarangModel extends Model
{
    protected $table            = 'barang';
    protected $primaryKey       = 'id_barang';
    protected $returnType       = 'object';
    protected $allowedFields    = ['id_pfi', 'nama_barang', 'merk_tipe', 'jumlah_barang', 'satuan', 'harga_barang', 'total_barang', 'keterangan', 'gambar'];
    protected $useTimestamps    = true;
    protected $useSoftDeletes   = false;

    function getAll()
    {
        $builder = $this->db->table('pfi');
        $builder->join('barang', 'barang.id_pfi = pfi.id_pfi');
        $query = $builder->get();
        return $query->getResult();
    }
    public function get_id($id)
    {
        $builder = $this->db->table('barang');
        $builder->where('id_pfi', $id);
        $results = $builder->get()->getResultArray();
        return $results;
    }
}
