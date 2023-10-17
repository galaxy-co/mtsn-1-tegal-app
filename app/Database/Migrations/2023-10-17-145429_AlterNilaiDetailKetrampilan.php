<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterNilaiDetailKetrampilan extends Migration
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
        $this->forge->modifyColumn('nilaiketrampilandetail', $fields);
    }

    public function down()
    {
        //
    }
}
