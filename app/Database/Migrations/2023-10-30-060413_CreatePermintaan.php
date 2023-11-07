<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePermintaan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_pfi' => [
                'type'           => 'BIGINT',
                'constraint'     => 20,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'tanggal_pfi' => [
                'type'       => 'date',
                'null' => true,
            ],
            'tanggal_revisi' => [
                'type' => 'date',
                'null' => true,
            ],
            'no_pfi' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
            ],
            'prioritas' => [
                'type' => 'int',
                'null' => true,
            ],
            'type' => [
                'type' => 'int',
                'null' => true,
            ],
            'id_unit' => [
                'type'           => 'BIGINT',
                'constraint'     => 20,
            ],
            'pengguna' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
            ],
            'dept' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
            ],
            'alasan_kebutuhan' => [
                'type' => 'text',
            ],
            'progres' => [
                'type'           => 'BIGINT',
                'constraint'     => 20,
            ],
            'nama_staff' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
            ],
            'nama_fat' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
            ],
            'nama_gm' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
            ],
            'nama_head' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
            ],
            'approve' => [
                'type' => 'VARCHAR',
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
        $this->forge->addKey('id_pfi', true);
        $this->forge->createTable('pfi');
    }

    public function down()
    {
        $this->forge->dropTable('pfi');
    }
}
