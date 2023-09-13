<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddColumnWaliKelasToKelas extends Migration
{
    public function up()
    {
        //
        $fields = [
            'id_guru' => [
                'type' => 'INT',
                'null' => true,
            ],
        ];
        $this->forge->addColumn('kelas', $fields);
    }

    public function down()
    {
        //
    }
}
