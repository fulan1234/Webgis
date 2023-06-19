<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Buangan extends BaseController
{
    function __construct()
    {
        $this->dataCabangModel = new DataCabangModel();
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
        // if (!$this->validate([
        //     'nama_daerah' => 'required',
        // ])) {
        //     return redirect()->to('/create');
        // }
        // $daerah = $this->request->getPost();
        // $this->daerah->insert($daerah);
        // // $daerahModel->save($_daerah);

        // return redirect()->to('/daerah');

        $data_dbf = $this->request->getFile('file_dbf');
        $data_geojson = $this->request->getFile('file');
		$fileName = $data_geojson->getRandomName();
        $fileName2 = $data_dbf->getRandomName();

        $simpanan = ".csv";
        $fileName2_potongan = explode('.', $fileName2);
        $ekstensiGambar = $fileName2_potongan[1];
        $fileName2_potongan[1] = $simpanan;

        $konz = implode($fileName2_potongan);

        // dd($konz);

        // dd($fileName2);
		$this->dataCabangModel->save([
            'namaDaerah' => $this->request->getPost('namaDaerah'),
			'file' => $fileName,
            'file_dbf' => $konz,
		]);
		$data_geojson->move('source_geojson/', $fileName);
        $data_dbf->move('source_dbf/', $konz);
        
        return redirect()->to('/dataCabang');
    }
}
