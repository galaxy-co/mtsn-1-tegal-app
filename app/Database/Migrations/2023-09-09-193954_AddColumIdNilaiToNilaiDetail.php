<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddColumIdNilaiToNilaiDetail extends Migration
{
    public function up()
    {
        //
        $fields = [
            'id_nilai' => [
                'type' => 'INT',
                'null' => false,
            ],
        ];
        $this->forge->addColumn('nilai_detail', $fields);
    }

    public function down()
    {
        //
    }
}
