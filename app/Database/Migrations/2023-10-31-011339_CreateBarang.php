<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateBarang extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_barang' => [
                'type'           => 'BIGINT',
                'constraint'     => 20,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_pfi' => [
                'type'           => 'BIGINT',
                'constraint'     => 20,
                'unsigned'       => true,
            ],
            'nama_barang' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'merk_tipe' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'jumlah_barang' => [
                'type'       => 'BIGINT',
            ],
            'satuan' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'harga_barang' => [
                'type'       => 'BIGINT',
            ],
            'total_barang' => [
                'type'       => 'BIGINT',
            ],
            'keterangan' => [
                'type'       => 'TEXT',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id_barang', true);
        $this->forge->addForeignKey('id_pfi', 'pfi', 'id_pfi', true);
        $this->forge->createTable('barang');
    }

    public function down()
    {
        $this->forge->dropForeignKey('pfi', 'id_pfi_user_foreign');
        $this->forge->dropTable('barang');
    }
}
