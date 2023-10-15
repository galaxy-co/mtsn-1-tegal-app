<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddColumnSemesterAndTAtoNilaiKetr extends Migration
{
    public function up()
    {
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
        $this->forge->addColumn('nilaiketrampilan', $fields);
    }

    public function down()
    {
        //
    }
}
