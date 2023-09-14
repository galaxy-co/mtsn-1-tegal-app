<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ModifyColumnDESCRFNilaiP5Option extends Migration
{
    public function up()
    {
        //
        $fields = [
            'desc' => [
                'name' => 'desc',
                'type' => 'TEXT',
                'null' => false,
            ],
            'arti' => [
                'name' => 'arti',
                'type' => 'TEXT',
                'null' => false,
            ],

        ];
        $this->forge->modifyColumn('rf_nilai_p5_options', $fields);
    }

    public function down()
    {
        //
    }
}
