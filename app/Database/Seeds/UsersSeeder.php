<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UsersSeeder extends Seeder
{
    public function run()
    {
        //
        $data = [
            [
                'name' => 'Super Admin',
                'username' => 'admin',
                'password' => password_hash('12345', PASSWORD_DEFAULT),
                'role_id' => 1,
            ],
            [
                'name' => 'Super Admin',
                'username' => 'admin1Mts1',
                'password' => password_hash('MtsN1@Tegal', PASSWORD_DEFAULT),
                'role_id' => 1,
            ],
            [
                'name' => 'Super Admin',
                'username' => 'admin2Mts1',
                'password' => password_hash('MtsN1@Tegal', PASSWORD_DEFAULT),
                'role_id' => 1,
            ],
            [
                'name' => 'Super Admin',
                'username' => 'admin3Mts1',
                'password' => password_hash('MtsN1@Tegal', PASSWORD_DEFAULT),
                'role_id' => 1,
            ],
            [
                'name' => 'Super Admin',
                'username' => 'admin4Mts1',
                'password' => password_hash('MtsN1@Tegal', PASSWORD_DEFAULT),
                'role_id' => 1,
            ],
            [
                'name' => 'Super Admin',
                'username' => 'admin5Mts1',
                'password' => password_hash('MtsN1@Tegal', PASSWORD_DEFAULT),
                'role_id' => 1,
            ],
            [
                'name' => 'Super Admin',
                'username' => 'admin6Mts1',
                'password' => password_hash('MtsN1@Tegal', PASSWORD_DEFAULT),
                'role_id' => 1,
            ],
            [
                'name' => 'Super Admin',
                'username' => 'admin7Mts1',
                'password' => password_hash('MtsN1@Tegal', PASSWORD_DEFAULT),
                'role_id' => 1,
            ],
            [
                'name' => 'Super Admin',
                'username' => 'admin8Mts1',
                'password' => password_hash('MtsN1@Tegal', PASSWORD_DEFAULT),
                'role_id' => 1,
            ],
            [
                'name' => 'Super Admin',
                'username' => 'admin9Mts1',
                'password' => password_hash('MtsN1@Tegal', PASSWORD_DEFAULT),
                'role_id' => 1,
            ],
            [
                'name' => 'Super Admin',
                'username' => 'admin10Mts1',
                'password' => password_hash('MtsN1@Tegal', PASSWORD_DEFAULT),
                'role_id' => 1,
            ],
           
        ];
        print_r($data);
        foreach($data as $dt){
            $this->db->table('users')->insert($dt);
        }
        // $this->db->table('users')->insert($data);
    }
}
