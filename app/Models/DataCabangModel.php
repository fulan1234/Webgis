<?php

namespace App\Models;

use CodeIgniter\Model;

class DataCabangModel extends Model
{
    protected $table            = 'data_cabang_kebun';
    protected $primaryKey       = 'id_cabang_kebun';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['nama_cabang_kebun'];
    protected $returnType       = 'object';

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}