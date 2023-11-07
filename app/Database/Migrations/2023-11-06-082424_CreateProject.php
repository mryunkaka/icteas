<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateProject extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_project' => [
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
            'nama_project' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'nama_project' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'jenis_pekerjaan' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'estimasi' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'rab' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'bapp' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'bast' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'status' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'null' => true,
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
        $this->forge->addKey('id_project', true);
        $this->forge->addForeignKey('id_unit', 'unit', 'id_unit', true);
        $this->forge->createTable('project');
    }

    public function down()
    {
        $this->forge->dropForeignKey('unit', 'id_unit_project_foreign');
        $this->forge->dropTable('project');
    }
}
