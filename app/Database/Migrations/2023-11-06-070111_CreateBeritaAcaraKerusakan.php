<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateBeritaAcaraKerusakan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_bak' => [
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
            'no_bak' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'tanggal_bak' => [
                'type'       => 'DATE',
            ],
            'dilaporkan_oleh' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'dept_pelapor' => [
                'type'       => 'VARCHAR',
                'constraint' => '120',
            ],
            'jenis_barang' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'merk_tipe' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'no_aset' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'serial_number' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'pengguna_aset' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'null' => true,
            ],
            'uraian_kejadian' => [
                'type'       => 'TEXT',
            ],
            'tindak_lanjut' => [
                'type'       => 'TEXT',
            ],
            'bisa_diperbaiki' => [
                'type'       => 'BIGINT',
                'constraint'     => 20,
            ],
            'jabatan_pelapor' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'diketahui_oleh' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'jabatan_mengetahui' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'ditindaklanjuti' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'jabatan_ditindaklanjuti' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'nama_diktetahui' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'jabatan_diketahui' => [
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
        $this->forge->addKey('id_bak', true);
        $this->forge->addForeignKey('id_unit', 'unit', 'id_unit', true);
        $this->forge->createTable('bak');
    }

    public function down()
    {
        $this->forge->dropForeignKey('unit', 'id_unit_bak_foreign');
        $this->forge->dropTable('bak');
    }
}
