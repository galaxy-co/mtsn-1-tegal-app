<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterColumnDescElementP5AndCapaian extends Migration
{
    public function up()
    {
        //
        $field = [
            'desc' => [
                'type'          => 'TEXT',
                'null'=>false
            ],
        ];

        $this->forge->modifyColumn('element_p5',$field);
        $this->forge->modifyColumn('capaian_p5',$field);
    }

    public function down()
    {
        //
    }
}
