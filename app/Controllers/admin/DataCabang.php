<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\DataCabangModel;
use App\Models\DataKebunModel;

class DataCabang extends BaseController
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

        return view('admin/fitur/dataCabang/dataCabang', $data);
    }

    public function create()
    {
        $data = [
            'data' => $this->dataCabangModel->findAll()
        ];

        return view('admin/fitur/dataCabang/create', $data);
    }

    public function delete($id){
        $this->dataCabangModel->delete($id);
        return redirect()->to('/dataCabang');
    }

    public function store()
    {
		$this->dataCabangModel->save([
            'nama_cabang_kebun' => $this->request->getPost('nama_cabang_kebun'),
		]);
        
        return redirect()->to('/dataCabang');
    }

    public function exportDataGeojson($id)
    {
        $kebun = strtolower($id);
        $konciAcil = $this->response->download('source_geojson/'.$kebun.'.geojson', null);
        return $konciAcil;
    }

    public function deleteCabang($id)
    {
        $dataModel = $this->dataCabangModel;
        $dataModel->delete($id);

        return redirect()->to('/dataCabang');
    }

    public function editCabang($id)
    {
        $dataModel = $this->dataCabangModel->find($id);

        $data = [
            'data' => $dataModel
        ];

        return view('admin/fitur/dataCabang/edit', $data);
    }

    public function updateCabang($id)
    {
        $_data = [
            'nama_cabang_kebun' => $this->request->getPost('nama_cabang_kebun')
        ]; 

        $this->dataCabangModel->update($id, $_data);
        return redirect()->to('/dataCabang');
    }
}
