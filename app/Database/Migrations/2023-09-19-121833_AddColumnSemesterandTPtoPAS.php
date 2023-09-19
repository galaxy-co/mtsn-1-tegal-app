<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddColumnSemestertoPas extends Migration
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
        $this->forge->addColumn('nilai_pas', $fields);
        $this->forge->addColumn('nilaip5', $fields);
        $this->forge->addColumn('projects', $fields);
        $this->forge->addColumn('dimensi_p5', $fields);
    }

    public function down()
    {
        //
    }
}
