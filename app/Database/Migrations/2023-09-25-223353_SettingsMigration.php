<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SettingsMigration extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_settings' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama_kepsek' => [
                'type'          => 'VARCHAR',
                'constraint'    => 100,
                'null'=>true
            ],
            'semester' => [
                'type'          => 'VARCHAR',
                'constraint'    => 100,
                'null'=>true
            ],
            'tahun_ajaran' => [
                'type'          => 'VARCHAR',
                'constraint'    => 100,
                'null'=>true
            ],
            'tanggal_cetak_raport' => [
                'type'          => 'VARCHAR',
                'constraint'    => 100,
                'null'=>true
            ],
        ]);
        $this->forge->addKey('id_settings', true);
        $this->forge->createTable('settings');
    }

    public function down()
    {
        $this->forge->dropTable('settings');
    }
}
