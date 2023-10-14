<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddTypeNilai extends Migration
{
    public function up()
    {
        //
        $this->forge->addField([
            'rf_nilai_detail_id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'rf_nilai_detail_desc' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'unique' => true
            ]
        ]);
        $this->forge->addKey('rf_nilai_detail_id', true);
        $this->forge->createTable('rfNilaiDetailKetrampilan');
    }

    public function down()
    {
        //
        $this->forge->dropTable('rfNilaiDetailKetrampilan');
    }
}
