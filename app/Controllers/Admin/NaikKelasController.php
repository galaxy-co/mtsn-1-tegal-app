<?php

namespace App\Controllers\Admin;
use App\Models\Admin\AbsenModel;
use App\Models\Admin\KelasModel;
use App\Models\Admin\SiswaModel;
use App\Controllers\BaseController;
use App\Database\Migrations\NilaiKetrampilanDetail;
use App\Models\Admin\NilaiModel;
use App\Models\Admin\NilaiDetailModel;
use App\Models\Admin\NilaiKetrampilanDetailModel;
use App\Models\Admin\NilaiKetrampilanModel;

class NaikKelasController extends BaseController
{
    protected $absenModel;
    protected $kelasModel;
    protected $siswaModel;
    protected $nilaiModel;
    protected $nilaiDetailModel;
    protected $nilaiKetModel;
    protected $nilaiKetDetailModel;
    public function __construct()
    {
        $this->absenModel = new AbsenModel();
        $this->kelasModel = new KelasModel();
        $this->siswaModel = new SiswaModel();
        $this->nilaiModel = new NilaiModel();
        $this->nilaiDetailModel = new NilaiDetailModel();
        $this->nilaiKetModel = new NilaiKetrampilanModel();
        $this->nilaiKetDetailModel = new NilaiKetrampilanDetailModel();
    }
    public function index()
    {
        $data['kelas'] = $this->kelasModel->findAll();
        echo view('admin/template_admin/header');
        echo view('admin/template_admin/sidebar');
        echo view('admin/kenaikan', $data);
        echo view('admin/template_admin/footer');
    }
    public function dataSiswa($id_kelas)
    {
        
        $data['siswa'] = $this->siswaModel->where('kelas', $id_kelas)->findAll();
        if(!empty($data['siswa'])){
            $id_siswa = array();
            $kelas = $this->kelasModel->where('id_kelas', $id_kelas)->first();
            $tingkat = $kelas['tingkat'] + 1;
            $tingkatKelas = $this->kelasModel->where('tingkat', $tingkat)->findAll();
            $data['tocheck'] = $kelas['tingkat'];
            // dd($data['tocheck']);
            $data['lulus'] = 0;
            
            $data['tingkatan'] = $tingkatKelas;
            if(!empty($data['siswa'])){
                foreach ($data['siswa'] as $siswa) {
                    $id_siswa[] = $siswa['id_siswa'];
                }
                $absensi = $this->absenModel->whereIn('id_siswa', $id_siswa)->findAll();
                $data['absensi'] = $absensi;
            }
            
        }else{
            $data['tingkatan'] = [];
            $data['tocheck'] = [];
        }        
       
        echo view('admin/template_admin/header');
        echo view('admin/template_admin/sidebar');
        echo view('admin/kenaikanSiswa', $data);
        echo view('admin/template_admin/footer');
    }
    public function add(){
        $dataSiswa = $this->request->getPost('siswa');
        $idKelas = $this->request->getPost('kelas');
        if($idKelas == 0){
            foreach ($dataSiswa as $siswaId) {
                $allNilai = $this->nilaiModel->where('id_siswa', $siswaId)->findAll();

                $this->siswaModel->delete($siswaId);

            }
        }
        foreach ($dataSiswa as $siswaId) {
            $dataToUpdate = ['kelas' => $idKelas];
            $this->siswaModel->update(['id' => $siswaId], $dataToUpdate);
        }

        session()->setFlashdata('success', 'Update Kelas berhasil');
        return redirect()->to('/admin/kenaikan');
    }
}
