<?php

namespace App\Controllers\Admin;
use App\Models\Admin\KelasModel;
use App\Models\Admin\GuruModel;

use App\Controllers\BaseController;

class KelasController extends BaseController
{
    protected $guruModel;
    protected $kelasModel;
    public function __construct()
    {
        $this->guruModel = new GuruModel();
        $this->kelasModel = new KelasModel();
    }

    public function index()
    {
        $data['guru'] = $this->guruModel->findAll();
        // $data['kelas'] = $this->kelasModel->findAll();

        $data['kelas_guru'] = $this->kelasModel
        ->select('kelas.*, guru.nama_guru AS nama_guru')
        ->join('guru', 'guru.id_guru = kelas.id_guru', 'left')
        ->findAll();
        
        echo view('admin/template_admin/header');
        echo view('admin/template_admin/sidebar');
        echo view('admin/kelas_in_admin', $data);
        echo view('admin/template_admin/footer');
    }
    public function addKelas(){
        
        $data = $this->request->getPost();

        $existingData = $this->kelasModel->where('tingkat', $data['tingkat'])
                                                ->where('nama_kelas', $data['nama_kelas'])
                                                ->first();
        if($existingData){
            session()->setFlashdata('warning', 'Data Kelas Sudah ada!');
            return redirect()->to('/admin/kelas');
        }
        $this->kelasModel->save($data);

        session()->setFlashdata('success', 'Sukses Input Kelas');
        return redirect()->to('/admin/kelas');
    }

    public function deleteKelas($id_kelas){
        // var_dump($id);
        // die;
        $id_kelas = intval($id_kelas);
        $this->kelasModel->delete($id_kelas);

        session()->setFlashdata('success', 'Sukses Hapus Data');

        return redirect()->to('/admin/kelas');
    }
    public function editKelas($id){
        $data['guru'] = $this->guruModel->findAll();
        $data['kelas'] = $this->kelasModel->find($id);
        echo view('admin/template_admin/header');
        echo view('admin/template_admin/sidebar');
        echo view('admin/edit_kelas_in_admin', $data);
        echo view('admin/template_admin/footer');
    }
    public function update($id){
        
        $data = $this->request->getPost();
        $this->kelasModel->update($id, $data);
        session()->setFlashdata('success', 'Update Kelas');

        return redirect()->to('/admin/kelas');
    }
}
