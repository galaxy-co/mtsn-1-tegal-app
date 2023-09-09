<?php

namespace App\Controllers\Admin;
use App\Models\Admin\SiswaModel;
use App\Models\Admin\KelasModel;
use App\Controllers\BaseController;

class SiswaController extends BaseController
{
    protected $siswaModel;
    protected $kelasModel;
    public function __construct()
    {
        $this->siswaModel = new SiswaModel();
        $this->kelasModel = new KelasModel();
        
    }
    public function index()
    {
        $data['siswa'] = $this->siswaModel->findAll();
        $data['kelas'] = $this->kelasModel->findAll();
        echo view('admin/template_admin/header');
        echo view('admin/template_admin/sidebar');
        echo view('admin/siswa_in_admin', $data);
        echo view('admin/template_admin/footer');
    }
    public function addSiswa()
    {
        $data = $this->request->getPost();

        $this->siswaModel->save($data);

        session()->setFlashdata('success', 'Siswa Di Tambahkan');

        return redirect()->to('/admin/siswa');
    }
}
