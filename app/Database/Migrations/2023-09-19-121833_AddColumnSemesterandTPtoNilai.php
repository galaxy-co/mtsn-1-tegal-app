<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddColumnSemestertoNilai extends Migration
{
    public function up()
    {
        //
        $fields = [
            'semester' => [
                'type' => 'INT',
                'null' => true,
            ],
            'tahun_ajaran' => [
                'type'          => 'VARCHAR',
                'constraint'    => 100,
                'null'          =>true
            ]
        ];
        $this->forge->addColumn('nilai', $fields);
    }

    public function down()
    {
        //
    }
}
