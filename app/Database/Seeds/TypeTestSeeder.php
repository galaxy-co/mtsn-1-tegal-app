<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TypeTestSeeder extends Seeder
{
    public function run()
    {
       $data = [
            [
                'type_test_desc' => 'PTS'
            ],
            [
                'type_test_desc' => 'PAS'
            ],
            [
                'type_test_desc' => 'STS'
            ],
            [
                'type_test_desc' => 'SAS'
            ],
            
       ];
       foreach($data as $dt){
        $this->db->table('type_test')->insert($dt);
    }
    }
}
