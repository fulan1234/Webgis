<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\DataCabangModel;
use App\Models\DataKebunModel;
use App\Models\DataSenaModel;

class Maps extends BaseController
{
    function __construct()
    {
        $this->dataCabangModel = new DataCabangModel();
        $this->dataKebunModel = new DataKebunModel();
        $this->dataSenaModel = new DataSenaModel();
    }

    public function index()
    {
        $dataKebun = array();
        $kumpulQuery = array();
        $dataCabang = $this->dataCabangModel;

        // Mendapatkan semua nama cabang model
        $ambilNamaData = $this->dataCabangModel->findAll();

        // mengumpulkan nama masing-masing cabang di array
        for ($i=0; $i < count($ambilNamaData); $i++) { 
            array_push($dataKebun , strtolower($ambilNamaData[$i]->nama_cabang_kebun));
        } // ['sena','tapi']

        // Menulis isi database dengan mengubahnya menjadi geojson dari masing2 setiap daerah
        for ($i=0; $i < count($dataKebun); $i++) {
            $query2 = $this->dataCabangModel->query("with tmp1 as (
                select 'Feature' as \"type\",
                    ST_AsGeoJSON(t.geom,6)::json as \"geometry\",
                    (
                        select json_strip_nulls(row_to_json(t))
                        from(
                            SELECT gid, fid_1, kebun, afdeling, blok, blok_sap, komoditi, tahuntanam, luas_ha, total_poko, pokok_per_, varietas, st_x(st_astext(st_GeometryN(st_centroid(geom),1))) ,st_y(st_astext(st_GeometryN(st_centroid(geom),1)))
                        ) t
                    ) as \"properties\"
                from public.data_".$dataKebun[$i]." t
            ), tmp2 as (
                    select 'FeatureCollection' as \"type\",
                        array_to_json(array_agg(t)) as \"features\"
                    from tmp1 t
            
            )	select row_to_json(t)
            from tmp2 t");

            $geo2 = $query2->getResult(); 
            $isi = $geo2[0]->row_to_json;

            $file = fopen("source_geojson/".$dataKebun[$i].".geojson", "w");
            fwrite($file, $isi);
            fclose($file);
        }

        // Menulis isi database dengan mengubahnya menjadi geojson dari masing2 setiap daerah
        for ($i=0; $i < count($dataKebun); $i++) {
            $query2 = $this->dataCabangModel->query("with tmp1 as (
                select 'Feature' as \"type\",
                    ST_AsGeoJSON(t.geom,6)::json as \"geometry\",
                    (
                        select json_strip_nulls(row_to_json(t))
                        from(
                            SELECT st_x(st_astext(st_GeometryN(st_centroid(geom),1))) ,st_y(st_astext(st_GeometryN(st_centroid(geom),1)))
                        ) t
                    ) as \"properties\"
                from public.hgu_".$dataKebun[$i]." t
            ), tmp2 as (
                    select 'FeatureCollection' as \"type\",
                        array_to_json(array_agg(t)) as \"features\"
                    from tmp1 t
            
            )	select row_to_json(t)
            from tmp2 t");

            $geo2 = $query2->getResult(); 
            $isi = $geo2[0]->row_to_json;

            $file = fopen("source_hgu/".$dataKebun[$i].".geojson", "w");
            fwrite($file, $isi);
            fclose($file);
        }

        // Ambil Model 
        $model = $this->dataSenaModel;
        $kebun = $this->dataCabangModel;

        $listAllMap = array();
        $dataKebun = array();

        $ambilNamaData = $this->dataCabangModel->findAll();

        for ($i=0; $i < count($ambilNamaData); $i++) { 
            array_push($listAllMap , strtolower($ambilNamaData[$i]->nama_cabang_kebun));
        } // ['sena','tapi']

        // Mengabil file dari masing2 file geojson
        for ($i=0; $i < count($listAllMap); $i++) { 
            $file = '';
            $file = file_get_contents("./source_geojson/".$listAllMap[$i].".geojson");
            $file = json_decode($file);

            $features = $file->features;
    
            foreach ($features as $index => $feature) {
                $kode_kebun = $feature->properties->blok_sap;
                $data = $model->where('blok_sap', $kode_kebun)
                ->where('kebun', $feature->properties->kebun)
                ->first();
            
                if($data)
                {
                    $features[$index]->properties->total_poko = $data->total_poko;
                }
            }
            array_push($dataKebun , $features);
        }

        // Menaruh Query awal ( Data sena )
        $potongan1 = "select max(total_poko) from (select fid_1, kebun, blok_sap, luas_ha, total_poko, pokok_per_ from data_".$listAllMap[0]."";
        
        // Menaruh query terusan ( sisa nama kebun yg ada buat dihubungin ke geojson )
        $kumpulQuery = array();
        for ($i=1; $i < count($listAllMap); $i++) { 
            array_push($kumpulQuery , " union select fid_1, kebun, blok_sap, luas_ha, total_poko, pokok_per_ from data_".$listAllMap[$i]." ");
        }

        // digabung masing2 kata menggunakan fungsi implode 
        $fileName2_potongan = implode('', $kumpulQuery);
        $hasilAkhir = $potongan1.''.$fileName2_potongan.') as siuu';
    
        // Menaruh Gabungan Query nya
        $hasil = $kebun->query($hasilAkhir)->getResult();
        $nilaiMax = $hasil[0]->max;

        // Jumlah cabang kebun
        $jumlahKebun = $dataCabang->countAll();

        $data = [
            'data' => $dataKebun,
            'nilaiMax' => $nilaiMax,
            'jumlahKebun' => $jumlahKebun
        ];

        return view('admin/Fitur/fileInti/maps',$data);

    }

    public function ambilData(){
        $data = $this->dataSenaModel;

        $students_id = $this->request->getVar('nilai');

        $dataKebun = array();
        $kumpulQuery = array();

        $ambilNamaData = $this->dataCabangModel->findAll();

        for ($i=0; $i < count($ambilNamaData); $i++) { 
            array_push($dataKebun , strtolower($ambilNamaData[$i]->nama_cabang_kebun));
        } // ['sena','tapi']

        $potongan1 = "select ".$students_id."  from data_".$dataKebun[0]."";
        $potongan2 = " order by ".$students_id." ";

        for ($i=1; $i < count($dataKebun); $i++) { 
            array_push($kumpulQuery , " union select ".$students_id." from data_".$dataKebun[$i]." ");
        }

        $fileName2_potongan = implode('', $kumpulQuery);

        $hasilAkhir = $potongan1.''.$fileName2_potongan.''.$potongan2;
        
        $query = $data->query($hasilAkhir)->getResult();

        return $this->response->setJSON($query);
    }
    
}
