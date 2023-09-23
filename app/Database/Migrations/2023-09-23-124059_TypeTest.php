<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TypeTest extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'type_test_id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'type_test_desc' => [
                'type'          => 'VARCHAR',
                'constraint'    => 100,
                'null'=>true
            ]
            ]);

            $this->forge->addKey('type_test_id', true);
            $this->forge->createTable('type_test');
    }

    public function down()
    {
        $this->forge->dropTable('type_test');
    }
}
