<?php

namespace App\Controllers\Admin;
use App\Models\Admin\AbsenModel;
use App\Models\Admin\KelasModel;
use App\Models\Admin\SiswaModel;
use App\Controllers\BaseController;

class AbsenController extends BaseController
{
    protected $absenModel;
    protected $kelasModel;
    protected $siswaModel;
    public function __construct()
    {
        $this->absenModel = new AbsenModel();
        $this->kelasModel = new KelasModel();
        $this->siswaModel = new SiswaModel();
    }

    public function index()
    {
        $data['kelas'] = $this->kelasModel->findAll();
        echo view('admin/template_admin/header');
        echo view('admin/template_admin/sidebar');
        echo view('admin/absen', $data);
        echo view('admin/template_admin/footer');
    }
    public function dataSiswa($id_kelas)
    {
        
        $data['siswa'] = $this->siswaModel->where('kelas', $id_kelas)->findAll();
        $id_siswa = array();

        foreach ($data['siswa'] as $siswa) {
            $id_siswa[] = $siswa['id_siswa'];
        }
        $absensi = $this->absenModel->whereIn('id_siswa', $id_siswa)->findAll();
        $data['absensi'] = $absensi;
        echo view('admin/template_admin/header');
        echo view('admin/template_admin/sidebar');
        echo view('admin/dataSiswa', $data);
        echo view('admin/template_admin/footer');
    }
    public function addAbsen($id_siswa)
    {
        $data['id_siswa'] = $id_siswa;
        echo view('admin/template_admin/header');
        echo view('admin/template_admin/sidebar');
        echo view('admin/addAbsen', $data);
        echo view('admin/template_admin/footer');
    }
    public function add(){
        $data = $this->request->getPost();;

        $this->absenModel->save($data);
             
        session()->setFlashdata('success', 'Input Absen');

        return redirect()->to('/admin/absen');
    }
    public function edit($id){
        $data['absen'] = $this->absenModel->find($id);
        echo view('admin/template_admin/header');
        echo view('admin/template_admin/sidebar');
        echo view('admin/editAbsen', $data);
        echo view('admin/template_admin/footer');
    }
    public function update($id){
        $siswa = $this->request->getPost('id_siswa');
        $kelas = $this->siswaModel->where('id_siswa', $siswa)->first();
        $idKelas = $kelas['kelas'];
       
        
        $data = $this->request->getPost();
        $this->absenModel->update($id, $data);
        session()->setFlashdata('success', 'Update Absen');

        return redirect()->to('/admin/absen/dataSiswa/' . $idKelas);
    }
}
