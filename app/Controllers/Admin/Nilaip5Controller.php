<?php

namespace App\Controllers\Admin;
use App\Models\Admin\KelasModel;
use App\Models\Admin\DimensiModel;
use App\Models\Admin\ProyekModel;
use App\Models\Admin\ElemenModel;
use App\Models\Admin\CapaianModel;
use App\Models\Admin\RFNilaiP5Model;

use App\Controllers\BaseController;

class Nilaip5Controller extends BaseController
{
    protected $kelasModel;
    public function __construct()
    {
        $this->kelasModel = new KelasModel();
        $this->DimensiModel = new DimensiModel();
        $this->ProyekModel = new ProyekModel();
        $this->ElemenModel = new ElemenModel();
        $this->CapaianModel = new CapaianModel();
        $this->RFNilaiP5Model = new RFNilaiP5Model();
    }

    private function getData($key = ''){
        switch ($key) {
            case 'dimensi':
                
                return [
                    'kelas' => $this->kelasModel->where('kurikulum',2)->findAll(),
                    'dimensi' => $this->DimensiModel->join('kelas','kelas.id_kelas = dimensi_p5.id_kelas','left')->findAll(),
                ];
                break;
            case 'elemen':
                return [
                    'elemen' => $this->ElemenModel
                        ->select('dimensi_p5.id_dimensi,dimensi_p5.dimensi,
                                element_p5.id_element,element_p5.kode_element,element_p5.desc,element_p5.id_parent_element,element_p5.nilai_rahmatan_lil_alamin,element_p5.sub_nilai,
                                element_p5_child.desc as element_parent_desc,element_p5_child.kode_element as kode_parent_element
                                '
                                )
                        ->join('element_p5 AS element_p5_child','element_p5_child.id_element = element_p5.id_parent_element','left')
                        ->join('dimensi_p5','dimensi_p5.id_dimensi = element_p5.dimensi','left')
                        ->findAll(),
                    'capaian' => $this->CapaianModel
                        ->select('capaian_p5.kode_capaian,capaian_p5.nilai_rahmatan_lil_alamin,capaian_p5.sub_nilai,capaian_p5.id_capaian,capaian_p5.desc,capaian_p5.id_parent_element, 
                        element_p5.desc as element_desc')
                        ->join('element_p5','element_p5.id_element = capaian_p5.id_parent_element','left')
                        ->findAll(),
                    'dimensi' => $this->DimensiModel->findAll()
                ];
                break;
            case 'proyek':
                return [
                    'proyek' => $this->ProyekModel->findAll(),
                ];
                break;
            case 'nilai':
                return [
                    'nilai' => $this->RFNilaiP5Model->findAll(),
                ];
                break;
            case 'penilaian':
                return [
                    'penilaian' => $this->PenilaianModel->findAll(),
                ];
                break;
            default:
                # code...
                break;
        }
    }

    private function getModel($key){
        switch ($key) {
            case 'dimensi':
                return new DimensiModel();
                break;
            case 'elemen' :
                return new ElemenModel();
                break;
            case 'capaian' :
                return new CapaianModel();
                break;
            case 'proyek':
                return new ProyekModel();
                break;
            case 'nilai':
                return new RFNilaiP5Model();
                break;
            default:
                # code...
                break;
        }
    }

    public function index($key = 'dimensi')
    {
        if($key == 'capaian') $key ='elemen';
        $data = $this->getData($key);

        echo view('admin/template_admin/header');
        echo view('admin/template_admin/sidebar');
        echo view('p5/'.$key, $data);
        echo view('admin/template_admin/footer');
    }

    public function store($key=null){
        $data = $this->request->getPost();
        // dd($data);
        $model = $this->getModel($key);

        
        $model->save($data);
        session()->setFlashdata('success', 'Sukses Input Kelas');
        return redirect()->to('/admin/p5/view/'.$key);
    }


    public function delete($key,$id){
        $model = $this->getModel($key);
        $model->delete($id);
        session()->setFlashdata('success', 'Sukses Delete Data');
        return redirect()->to('/admin/p5/view/'.$key);
    }

}
