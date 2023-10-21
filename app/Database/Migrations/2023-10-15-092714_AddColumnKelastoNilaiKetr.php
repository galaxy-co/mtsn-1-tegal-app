<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddColumnKelastoNilaiKetr extends Migration
{
    public function up()
    {
        $fields = [
            'id_kelas' => [
                'type' => 'INT',
                'null' => true,
            ],
        ];
        $this->forge->addColumn('nilaiKetrampilan', $fields);
    }

    public function down()
    {
        //
    }
}
