<?php

namespace App\Models;

use CodeIgniter\Model;

class DataSenaModel extends Model
{
    protected $table            = 'data_sena';
    protected $primaryKey       = 'gid';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'object';
    protected $allowedFields    = ['fid_1', 'kebun','afdeling','blok','blok_sap','tahuntanam', 'luas_ha',
                                    'total_poko', 'pokok_per_','varietas', 'geom'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

}
