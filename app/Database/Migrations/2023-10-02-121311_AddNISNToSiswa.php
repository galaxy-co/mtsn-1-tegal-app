<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddNISNToSiswa extends Migration
{
    public function up()
    {
        //
        $fields = [
            'nisn' => [
                'type' => 'VARCHAR',
                'constraint' => 40,
                'null' => true,
            ]
        ];
        $this->forge->addColumn('siswa', $fields);
    }

    public function down()
    {
        //
        $this->forge->dropColumn('siswa','nisn');
    }
}
