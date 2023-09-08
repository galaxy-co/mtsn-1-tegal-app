<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RoleSeeders extends Seeder
{
    public function run()
    {
        //

        $data = [
            [
                "role_desc" => "Admin"
            ],[
                "role_desc" => "Guru"
            ],[
                "role_desc" => "Siswa"
            ],[
                "role_desc" => "Kepala Sekolah"
            ]
        ];
        foreach($data as $dt){
            $this->db->table('roles')->insert($dt);
        }
    }
}
