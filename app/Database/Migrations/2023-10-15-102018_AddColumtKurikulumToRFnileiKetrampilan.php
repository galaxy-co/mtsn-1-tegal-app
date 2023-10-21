<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddColumtKurikulumToRFnileiKetrampilan extends Migration
{
    public function up()
    {
        $fields = [
            'kurikulum_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'null' => true,
            ],
        ];
        $this->forge->addColumn('rfNilaiDetailKetrampilan', $fields);
    }

    public function down()
    {
        //
    }
}
