<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UsersSeeder extends Seeder
{
    public function run()
    {
        //
        $data = [
            'name' => 'Super Admin',
            'username' => 'admin',
            'password' => password_hash('12345', PASSWORD_DEFAULT),
            'role_id' => 1,
        ];
        print_r($data);
        $this->db->table('users')->insert($data);
    }
}
