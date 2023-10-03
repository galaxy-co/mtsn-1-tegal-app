<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddKKMToRFMapel extends Migration
{
    public function up()
    {
        //
        $fields = [
            'kkm' => [
                'type'          => 'FLOAT',
                'constraint'    => ''
            ],
        ];
        $this->forge->addColumn('rfmapel', $fields);
    }

    public function down()
    {
        //
        $this->forge->dropColumn('rfmapel','kkm');
    }
}
