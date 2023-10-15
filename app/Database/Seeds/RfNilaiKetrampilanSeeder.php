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
                "kurikulum_id" => 1
            ],[
                "rf_nilai_detail_desc" => "Project",
                "kurikulum_id" => 1
            ],[
                "rf_nilai_detail_desc" => "Portofolio",
                "kurikulum_id" => 1
            ],[
                "rf_nilai_detail_desc" => "Nilai Akhir",
                "kurikulum_id" => 1
            ],
        ];
        foreach($data as $dt){
            $this->db->table('rfNilaiDetailKetrampilan')->insert($dt);
        }
    }
}
