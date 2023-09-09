<?php

namespace App\Controllers\Admin;
use App\Models\Admin\NilaiModel;
use App\Models\Admin\KelasModel;
use App\Models\Admin\GuruModel;
use App\Models\Admin\MapelModel;
use App\Models\Admin\SiswaModel;

use App\Controllers\BaseController;

class NilaiController extends BaseController
{
    protected $NilaiModel;
    public function __construct()
    {
        $this->NilaiModel = new NilaiModel();
        $this->KelasModel = new KelasModel();
        $this->GuruModel = new GuruModel();
        $this->MapelModel = new MapelModel();
        $this->SiswaModel = new SiswaModel();
    }

    public function index()
    {
        $data['nilai'] = $this->NilaiModel->findAll();
        $data['kelas'] = $this->KelasModel->findAll();
        $data['guru'] = $this->GuruModel->findAll();
        $data['mapel'] = $this->MapelModel->findAll();
        
        echo view('admin/template_admin/header');
        echo view('admin/template_admin/sidebar');
        echo view('nilai/index', $data);
        echo view('admin/template_admin/footer');
    }

    public function add(){
        
        $data = $this->request->getPost();

        // if($existingData){
        //     session()->setFlashdata('warning', 'Data Kelas Sudah ada!');
        //     return redirect()->to('/admin/kelas');
        // }
        $saveNilai = $this->NilaiModel->save($data);

        $id = $this->NilaiModel->getInsertID();

        session()->setFlashdata('success', 'Sukses Input Kelas');
        return redirect()->to('/admin/nilai/detail/'.$id);
    }

    public function detail($id){
        $data['nilai'] =$this->NilaiModel->find($id);
        
        $data['siswa'] =$this->SiswaModel->where('kelas',$data['nilai']['id_kelas'])->findAll();
        $data['mapel'] =$this->MapelModel->where('tingkal_kelas',$data['nilai']['id_kelas'])->findAll();
        // dd($data);
        echo view('admin/template_admin/header');
        echo view('admin/template_admin/sidebar');
        echo view('nilai/detail', $data);
        echo view('admin/template_admin/footer');
    }

    public function delete($id_kelas){
        // var_dump($id);
        // die;
        $id_kelas = intval($id_kelas);
        $this->NilaiModel->delete($id_kelas);

        session()->setFlashdata('success', 'Sukses Hapus Data');

        return redirect()->to('/admin/kelas');
    }

    public function edit($id){
        $data['kelas'] = $this->NilaiModel->find($id);
        echo view('admin/template_admin/header');
        echo view('admin/template_admin/sidebar');
        echo view('admin/edit_kelas_in_admin', $data);
        echo view('admin/template_admin/footer');
    }
}
