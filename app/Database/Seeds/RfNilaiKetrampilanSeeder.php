<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RfNilaiKetrampilanSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                "rf_nilai_detail_desc" => "Kinerja",
            ],[
                "rf_nilai_detail_desc" => "Project",
            ],[
                "rf_nilai_detail_desc" => "Portofolio",
            ],[
                "rf_nilai_detail_desc" => "Nilai Akhir",
            ],
        ];
        foreach($data as $dt){
            $this->db->table('rfNilaiDetailKetrampilan')->insert($dt);
        }
    }
}
