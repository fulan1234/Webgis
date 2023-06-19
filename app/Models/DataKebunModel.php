<?php

namespace App\Models;

use CodeIgniter\Model;

class DataKebunModel extends Model
{
    protected $table            = 'data_kebun';
    protected $primaryKey       = 'gid';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'object';
    protected $allowedFields    = ['fid_1', 'kebun','afdeling','blok','blok_sap','komoditi','tahuntanam', 'luas_ha', 'total_poko', 'pokok_per_','varietas', 'geom'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    function getAll(){
        $builder = $this->db->table('data_kebun');
        $builder->join('data_TAPI','data_TAPI.komoditi = data_kebun.komoditi');
        $query = $builder->get();
        return $query->getResult();
    }
}
