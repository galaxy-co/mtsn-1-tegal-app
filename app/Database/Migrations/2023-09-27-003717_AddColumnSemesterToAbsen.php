<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddColumnSemesterToAbsen extends Migration
{
    public function up()
    {
        $fields = [
            'semester' => [
                'type' => 'INT',
                'constraint' => 5,
                'null' => true,
            ],
            'tahun_ajaran' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ]
        ];
        $this->forge->addColumn('absen', $fields);
    }

    public function down()
    {
        //
    }
}
