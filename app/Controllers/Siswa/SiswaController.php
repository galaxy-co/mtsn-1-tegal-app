<?php

namespace App\Controllers\Siswa;
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
        $session = session();
        $name = $session->get('name');
        $nism = $session->get('username');
        $siswa = $this->siswaModel->where('nism', $nism)->first();
        $idKelas = $siswa['kelas'];
        $kelas = $this->kelasModel->where('id_kelas', $idKelas)->first();
        $data['kurikulum'] = $kelas['kurikulum'];
        $data['kelas'] = $kelas['tingkat'] . " " . $kelas['nama_kelas'];
        $data['name'] = $name;
        echo view('admin/template_admin/header');
        echo view('admin/template_admin/sidebar_siswa', $data);
        echo view('siswa/index', $data);
        echo view('admin/template_admin/footer');
    }
}
