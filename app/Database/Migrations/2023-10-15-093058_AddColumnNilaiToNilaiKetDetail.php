<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddColumnNilaiToNilaiKetDetail extends Migration
{
    public function up()
    {
        $fields = [
            'id_nilai' => [
                'type' => 'INT',
                'null' => false,
            ],
        ];
        $this->forge->addColumn('nilaiketrampilandetail', $fields);
    }

    public function down()
    {
        //
    }
}
