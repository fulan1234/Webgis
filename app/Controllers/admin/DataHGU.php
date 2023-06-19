<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\DataKebunModel;
use App\Models\DataCabangModel;
use App\Models\DataSenaModel;

class DataHGU extends BaseController
{
    function __construct()
    {
        $this->dataCabangModel = new DataCabangModel();
        $this->dataKebunModel = new DataKebunModel();
    }

    public function index()
    {
        $data = [
            'data' => $this->dataCabangModel->findAll()
        ];

        return view('admin/fitur/dataHGU/dataHGU', $data);
    }

    public function tampilData($id)
    {
        $ambil_data = $this->dataCabangModel->find($id)->nama_cabang_kebun;

        $siuu = strtolower($ambil_data);

        // dd($ambil_data);


        $data = $this->dataCabangModel;

        // $hasilData = $data->select('*')
        //             ->join('data_"'.$siuu.'"', 'data_cabang_kebun.nama_cabang_kebun = data_"'.$siuu.'".kebun ')
        //             ->get();

        // $datas = $data->select('*')
        //             ->join('data_sena', 'data_cabang_kebun.nama_cabang_kebun = data_sena.kebun')
        //             ->get();

        $query = $data->query("select * from data_cabang_kebun
        join data_".$siuu."
        on data_cabang_kebun.nama_cabang_kebun = data_".$siuu.".kebun");
    
        $_data = [
            'data' => $query->getResult(),
            'dataKebun' => $ambil_data
        ];
        return view('admin/fitur/dataHGU/dataKebunHGU', $_data);
    }
}
