<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAset extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_aset' => [
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
            'no_aset' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'form_bast' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'desc_aset' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'lokasi' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'user' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'foto_aset' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'tahun_perolehan' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'usia' => [
                'type'       => 'BIGINT',
                'constraint' => 20,
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
        $this->forge->addKey('id_aset', true);
        $this->forge->addForeignKey('id_unit', 'unit', 'id_unit', true);
        $this->forge->createTable('aset');
    }

    public function down()
    {
        $this->forge->dropForeignKey('unit', 'id_unit_aset_foreign');
        $this->forge->dropTable('aset');
    }
}
