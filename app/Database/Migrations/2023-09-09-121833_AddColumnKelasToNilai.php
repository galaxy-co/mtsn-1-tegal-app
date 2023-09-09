<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddColumnKelasToNilai extends Migration
{
    public function up()
    {
        //
        $fields = [
            'id_kelas' => [
                'type' => 'INT',
                'null' => true,
            ],
        ];
        $this->forge->addColumn('nilai', $fields);
    }

    public function down()
    {
        //
    }
}
