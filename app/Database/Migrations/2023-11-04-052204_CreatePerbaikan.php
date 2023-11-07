<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePerbaikan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_perbaikan' => [
                'type'           => 'BIGINT',
                'constraint'     => 20,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_unit' => [
                'type'           => 'BIGINT',
                'constraint'     => 20,
                'unsigned'       => true,
            ],
            'no_perbaikan' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'tanggal_perbaikan' => [
                'type'       => 'DATE',
            ],
            'nama_pemohon' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'jabatan_pemohon' => [
                'type'       => 'VARCHAR',
                'constraint' => '120',
            ],
            'dept_pemohon' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'jenis_barang' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'jb_lainnya' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'masalah' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'lainya' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'null' => true,
            ],
            'masalah_kerusakan' => [
                'type'       => 'VARCHAR',
                'constraint' => '120',
            ],
            'diperiksa' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'jabatan_pemeriksa' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'disetujui' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'jabatan_menyetujui' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'diketahui' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'jabatan_mengetahui' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
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
        $this->forge->addKey('id_perbaikan', true);
        $this->forge->addForeignKey('id_unit', 'unit', 'id_unit', true);
        $this->forge->createTable('perbaikan');
    }

    public function down()
    {
        $this->forge->dropForeignKey('unit', 'id_unit_perbaikan_foreign');
        $this->forge->dropTable('perbaikan');
    }
}
