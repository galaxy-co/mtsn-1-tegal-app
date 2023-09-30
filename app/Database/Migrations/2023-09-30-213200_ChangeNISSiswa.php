<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ChangeNISSiswa extends Migration
{
    public function up()
    {
        $fields = [
            'nism' => [
                'name' => 'nism',
                'type' => 'BIGINT',
                'constraint' => '50'
            ],
        ];
        $this->forge->modifyColumn('siswa', $fields);
    }

    public function down()
    {
        //
    }
}
