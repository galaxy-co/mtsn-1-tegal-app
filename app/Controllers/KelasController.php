<?php

namespace App\Controllers;
use App\Models\Admin\KelasModel;

class KelasController extends BaseController

{
  
    protected $kelasModel;
    public function __construct()
    {
        $this->kelasModel = new KelasModel();
    }

    public function index()
    {
        $data['kelas'] = $this->kelasModel->findAll();
        echo view('admin/template_admin/header');
        echo view('admin/template_admin/sidebar');
        echo view('admin/kelas_in_admin', $data);
        echo view('admin/template_admin/footer');
    }

    public function addKelas(){
        $data = $this->request->getPost();
        $this->kelasModel->save($data);

        session()->setFlashdata('success', 'Sukses Input Kelas');
        return redirect()->to('/admin/kelas');
    }
}