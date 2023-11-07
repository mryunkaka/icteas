<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Email extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_email' => [
                'type'           => 'BIGINT',
                'constraint'     => 20,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'no_email' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'tanggal_email' => [
                'type'       => 'DATE',
            ],
            'id_unit' => [
                'type'           => 'BIGINT',
                'constraint'     => 20,
                'unsigned'       => true,
            ],
            'nama_pemohon' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'jabatan_email' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'dept_email' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'opsi_email' => [
                'type'       => 'BIGINT',
                'constraint' => 50,
            ],
            'pemohon_email' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'perangkat_user' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'akses_email' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'akses_keperluan' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'alamat_email' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'keterangan' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'nama_sect_head' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'nama_div_head' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'jabatan_sect_head' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'jabatan_div_head' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'div_hrga' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'div_ict' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'status' => [
                'type'       => 'BIGNT',
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
        $this->forge->addKey('id_email', true);
        $this->forge->addForeignKey('id_unit', 'unit', 'id_unit', true);
        $this->forge->createTable('email');
    }

    public function down()
    {
        $this->forge->dropForeignKey('unit', 'id_unit_email_foreign');
        $this->forge->dropTable('email');
    }
}
