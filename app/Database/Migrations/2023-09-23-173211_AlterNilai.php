<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterNilai extends Migration
{
    public function up()
    {
        //
        $fields =[
            'nilai' => [
                'type'       => 'FLOAT',
                'constraint' => 5,
                'null'=>true
            ],
        ];
        $this->forge->modifyColumn('nilai_detail', $fields);
    }

    public function down()
    {
        //
        // $this->forge->dropColumn('nilai_detail','id_project_dimensi');
    }
}
