<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUnit extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_unit' => [
                'type'           => 'BIGINT',
                'constraint'     => 20,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama_unit' => [
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
        $this->forge->addKey('id_unit', true);
        $this->forge->createTable('unit');
    }

    public function down()
    {
        $this->forge->dropTable('unit');
    }
}
