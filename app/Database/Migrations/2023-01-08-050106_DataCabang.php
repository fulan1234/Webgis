<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DataCabang extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'idDaerah' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'namaDaerah' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'file' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'file_dbf' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true
            ],
        ]);
        $this->forge->addKey('idDaerah', true);
        $this->forge->createTable('data_Cabang');
    }

    public function down()
    {
        $this->forge->dropTable('data_Cabang');
    }
}
