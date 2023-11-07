<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateDowntime extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_downtime' => [
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
            'tanggal_input' => [
                'type'       => 'DATE',
            ],
            'down_awal' => [
                'type'       => 'DATETIME',
            ],
            'down_akhir' => [
                'type'       => 'DATETIME',
            ],
            'interval' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'keterangan' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
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
        $this->forge->addKey('id_downtime', true);
        $this->forge->addForeignKey('id_unit', 'unit', 'id_unit', true);
        $this->forge->createTable('downtime');
    }

    public function down()
    {
        $this->forge->dropForeignKey('unit', 'id_unit_user_foreign');
        $this->forge->dropTable('downtime');
    }
}
