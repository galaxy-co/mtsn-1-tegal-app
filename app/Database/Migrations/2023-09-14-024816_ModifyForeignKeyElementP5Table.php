<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ModifyForeignKeyElementP5Table extends Migration
{
    public function up()
    {
        //
        $this->forge->dropForeignKey('element_p5', 'id_parent_element');
        $this->forge->addForeignKey('id_parent_element', 'element_p5', 'id_element', 'CASCADE', 'CASCADE','id_parent_element');
        $this->forge->processIndexes('element_p5');
    }

    public function down()
    {
        //
        $this->forge->dropForeignKey('element_p5', 'id_parent_element');
    }
}
