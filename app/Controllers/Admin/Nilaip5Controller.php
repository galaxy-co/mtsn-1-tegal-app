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
                    'elemen' => $this->ElemenModel->findAll(),
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
