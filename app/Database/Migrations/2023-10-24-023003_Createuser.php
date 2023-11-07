<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUser extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_user' => [
                'type'           => 'BIGINT',
                'constraint'     => 20,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'username' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'nik_name' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'name_user' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'email_user' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'password_user' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'jabatan_user' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'id_unit' => [
                'type'           => 'BIGINT',
                'constraint'     => 20,
                'unsigned'       => true,
            ],
            'status' => [
                'type'           => 'BIGINT',
                'constraint'     => 20,
                'default'        => '0',
            ],
            'ttd' => [
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
        $this->forge->addKey('id_user', true);
        $this->forge->addForeignKey('id_unit', 'unit', 'id_unit', true);
        $this->forge->createTable('users');
    }

    public function down()
    {
        $this->forge->dropForeignKey('unit', 'id_unit_users_foreign');
        $this->forge->dropTable('users');
    }
}
