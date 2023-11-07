<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'name_user' => 'Administrator',
            'email_user' => 'mryunkaka@gmail.com',
            'password_user' => password_hash('12345', PASSWORD_BCRYPT),
        ];
        $this->db->table('users')->insert($data);

        //tambah multi user
        // $data = [
        //     [
        //         'name_user' => 'Sayid Adam',
        //         'email_user' => 'mryunkaka@gmail.com',
        //         'password_user' => password_hash('sayid', PASSWORD_BCRYPT),
        //     ],
        //     [
        //         'name_user' => 'Anto',
        //         'email_user' => 'mryunkaka@gmail.com',
        //         'password_user' => password_hash('adam', PASSWORD_BCRYPT),
        //     ]
        // ];
        $this->db->table('users')->insertBatch($data);
    }
}
