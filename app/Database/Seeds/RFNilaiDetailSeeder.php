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
                "rf_nilai_detail_desc" => "Tes Tertulis",
                "kurikulum_id" => 1
            ],[
                "rf_nilai_detail_desc" => "Tugas",
                "kurikulum_id" => 1
            ],[
                "rf_nilai_detail_desc" => "Remidi",
                "kurikulum_id" => 1
            ],[
                "rf_nilai_detail_desc" => "Nilai Akhir",
                "kurikulum_id" => 1
            ],
            [
                "rf_nilai_detail_desc" => "TP 1",
                "kurikulum_id" => 2
            ],[
                "rf_nilai_detail_desc" => "TP 2",
                "kurikulum_id" => 2
            ],[
                "rf_nilai_detail_desc" => "TP 3",
                "kurikulum_id" => 2
            ],[
                "rf_nilai_detail_desc" => "TP 4",
                "kurikulum_id" => 2
            ],[
                "rf_nilai_detail_desc" => "TP 5",
                "kurikulum_id" => 2
            ]
        ];
        foreach($data as $dt){
            $this->db->table('rfNilaiDetail')->insert($dt);
        }
    }
}
