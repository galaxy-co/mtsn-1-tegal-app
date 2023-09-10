<?php

namespace App\Controllers\Admin;
use App\Models\Admin\AbsenModel;
use App\Models\Admin\KelasModel;
use App\Models\Admin\SiswaModel;
use App\Controllers\BaseController;

class NaikKelasController extends BaseController
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
        echo view('admin/kenaikan', $data);
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
        echo view('admin/kenaikanSiswa', $data);
        echo view('admin/template_admin/footer');
    }
}
