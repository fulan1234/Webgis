<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DataExcel extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_data' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'kebun' => [
                'type'       => 'VARCHAR',
                'constraint' => 10,
            ],
            'file' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'tahun_tanam' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'total_poko' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'idDaerah' => [
                'type'           => 'INT',
                'constraint'     => 11,
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
        $this->forge->addKey('id_data', true);
        $this->forge->createTable('data_excel');
    }

    public function down()
    {
        $this->forge->dropTable('data_excel');
    }
}
