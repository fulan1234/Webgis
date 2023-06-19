<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\DataKebunModel;
use App\Models\DataCabangModel;
use App\Models\DataSenaModel;

class DataKebun extends BaseController
{
    function __construct()
    {
        $this->dataKebunModel = new DataKebunModel();
        $this->dataCabangModel = new DataCabangModel();
        $this->dataSenaModel = new DataSenaModel();
    }

    public function index()
    {
        $dataKebun = array();
        $kumpulQuery = array();

        $ambilNamaData = $this->dataCabangModel->findAll();

        for ($i=0; $i < count($ambilNamaData); $i++) { 
            array_push($dataKebun , strtolower($ambilNamaData[$i]->nama_cabang_kebun));
        } // ['sena','tapi']


        $data = $this->dataSenaModel;

        $potongan1 = "select kebun, blok_sap, luas_ha, afdeling, komoditi, tahuntanam, total_poko, pokok_per_  from data_".$dataKebun[0]."";

        for ($i=1; $i < count($dataKebun); $i++) { 
            array_push($kumpulQuery , " union select kebun, blok_sap, luas_ha, afdeling, komoditi, tahuntanam, total_poko, pokok_per_  from data_".$dataKebun[$i]." ");
        }

        $file3 = fopen("source_geojson/semua.geojson", "w");
        fwrite($file3, '');

        for ($i=0; $i < count($dataKebun); $i++) { 
            $query2 = $this->dataCabangModel->query("with tmp1 as (
                select 'Feature' as \"type\",
                    ST_AsGeoJSON(t.geom,6)::json as \"geometry\",
                    (
                        select json_strip_nulls(row_to_json(t))
                        from(
                            SELECT gid, fid_1, kebun, afdeling, blok, blok_sap, komoditi, tahuntanam, luas_ha, total_poko, pokok_per_, varietas, ST_AsText(geom)
                        ) t
                    ) as \"properties\"
                from public.data_".$dataKebun[$i]." t
            ), tmp2 as (
                    select 'FeatureCollection' as \"type\",
                        array_to_json(array_agg(t)) as \"features\"
                    from tmp1 t
            
            )	select row_to_json(t)
            from tmp2 t");
    
            // dd($query2);
    
            $geo2 = $query2->getResult();
    
            $isi = $geo2[0]->row_to_json;
    
            $file = fopen("source_geojson/".$dataKebun[$i].".geojson", "w");
            fwrite($file, $isi);
            fclose($file);

            $file2 = fopen("source_geojson/semua.geojson", "a+");
            fwrite($file2, $isi);
            fclose($file2);
        }
        fclose($file3);

        $fileName2_potongan = implode('', $kumpulQuery);

        $orderBy = " order by kebun";

        $hasilAkhir = $potongan1.''.$fileName2_potongan.''.$orderBy;

        
        $query = $data->query($hasilAkhir);

        $data = [
            'data' => $query->getResult()
        ];

        return view('admin/fitur/dataKebun/dataKebun', $data);
    }

    public function create()
    {
        $data = [
            'data' => $this->dataCabangModel->findAll()
        ];

        return view('admin/fitur/dataKebun/create', $data);
    }

    public function delete($id){
        $this->dataCabangModel->delete($id);
        return redirect()->to('/dataKebun');
    }

    public function store()
    {
        $data_dbf = $this->request->getFile('file_dbf');
        $data_geojson = $this->request->getFile('file');
		$fileName = $data_geojson->getRandomName();
        $fileName2 = $data_dbf->getRandomName();

        $simpanan = ".csv";
        $fileName2_potongan = explode('.', $fileName2);
        $ekstensiGambar = $fileName2_potongan[1];
        $fileName2_potongan[1] = $simpanan;

        $konz = implode($fileName2_potongan);

		$this->dataCabangModel->save([
            'namaDaerah' => $this->request->getPost('namaDaerah'),
			'file' => $fileName,
            'file_dbf' => $konz,
		]);
		$data_geojson->move('source_geojson/', $fileName);
        $data_dbf->move('source_dbf/', $konz);
        
        return redirect()->to('/dataKebun');
    }

    public function ambilDataKebun($gid,$kebun)
    {
        $this->dataCabangModel = new DataCabangModel();
        $model = $this->dataKebunModel;

        $dataKebun = array();
        $kumpulQuery = array();

        $ambilNamaData = $this->dataCabangModel->findAll();

        for ($i=0; $i < count($ambilNamaData); $i++) { 
            array_push($dataKebun , strtolower($ambilNamaData[$i]->nama_cabang_kebun));
        } // ['sena','tapi']

        $data = $this->dataSenaModel;

        $potongan1 = "select fid_1, kebun, blok_sap, luas_ha, afdeling, komoditi, tahuntanam, total_poko, pokok_per_ from data_".$dataKebun[0]." ";

        for ($i=1; $i < count($dataKebun); $i++) { 
            array_push($kumpulQuery , "union select fid_1, kebun, blok_sap, luas_ha, afdeling, komoditi, tahuntanam, total_poko, pokok_per_ from data_".$dataKebun[$i]." ");
        }

        $fileName2_potongan = implode('', $kumpulQuery);

        $hasilAkhir = $potongan1.''.$fileName2_potongan;
        
        $query = $data->query($hasilAkhir)->getResult();

        // //////////////////////////////////////////////////////////////////////////////////////////////////

		$file = file_get_contents("./source_geojson/".$kebun.".geojson");
		$file = json_decode($file);

		$features = $file->features;

        foreach ($features as $index => $feature) {
            $kode_kebun = $feature->properties->blok_sap;
            $dataz = $model->where('blok_sap', $kode_kebun)
            ->where('kebun', $kebun)
            ->first();
        
            if($dataz)
            {
                $features[$index]->properties->total_poko = $dataz->total_poko;
            }
        }

        // dd($features);

        // $nilaiMax = $model->select('MAX(total_poko) AS pekok')->where('kebun', $kebun)->first()->total_poko;

        $nilaiMax = $model->query("select MAX(total_poko) from data_".$kebun."")->getResult();

        $geoQuery = $this->dataKebunModel->query("select st_x(st_astext(st_GeometryN(st_centroid(geom),1))) ,st_y(st_astext(st_GeometryN(st_centroid(geom),1))) from data_".$kebun." where blok_sap = '".$gid."'");
        $geo = $geoQuery->getResult();

        // dd($geo);

        $data2 = $this->dataCabangModel->query("select * from (".$hasilAkhir.") as kante where blok_sap = '".$gid."' ")->getResult();
        
        $query2 = $this->dataCabangModel->query("with tmp1 as (
            select 'Feature' as \"type\",
                ST_AsGeoJSON(t.geom,6)::json as \"geometry\",
                (
                    select json_strip_nulls(row_to_json(t))
                    from(
                        SELECT gid, fid_1, kebun, afdeling, blok, blok_sap, komoditi, tahuntanam, luas_ha, total_poko, pokok_per_, varietas, ST_AsText(geom)
                    ) t
                ) as \"properties\"
            from public.data_sena t
        ), tmp2 as (
                select 'FeatureCollection' as \"type\",
                    array_to_json(array_agg(t)) as \"features\"
                from tmp1 t
        
        )	select row_to_json(t)
        from tmp2 t");

        $geo2 = $query2->getResult();

        $seika = $geo2[0]->row_to_json;

        // dd($seika);
        $_data = [
            'data' => $data2,
            'dataz' => $features,
            'data2' => $data2[0]->fid_1,
            'nilaiMax' => $nilaiMax[0]->max,
            'longlang' => $geo,
            'seika' => $seika
        ];
        
        return view('/admin/fitur/maps/data', $_data);
    }

    public function tampilDataKebun($id)
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
        return view('admin/fitur/dataKebun/dataKebun', $_data);
    }
}
