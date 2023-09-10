<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RFNilaiDetailSeeder extends Seeder
{
    public function run()
    {
        //
        $data = [
            [
                "rf_nilai_detail_desc" => "Tes Tertulis"
            ],[
                "rf_nilai_detail_desc" => "Tugas"
            ],[
                "rf_nilai_detail_desc" => "Remidi"
            ]
        ];
        foreach($data as $dt){
            $this->db->table('rfNilaiDetail')->insert($dt);
        }
    }
}
