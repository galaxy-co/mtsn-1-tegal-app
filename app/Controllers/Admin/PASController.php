<?php

namespace App\Controllers\Admin;
use App\Models\Admin\NilaiModel;
use App\Models\Admin\KelasModel;
use App\Models\Admin\GuruModel;
use App\Models\Admin\MapelModel;
use App\Models\Admin\SiswaModel;
use App\Models\Admin\PASModel;
use App\Models\Admin\TypeTestModel;
use App\Controllers\BaseController;
use App\Database\Migrations\Mapel;

class PASController extends BaseController
{
    protected $nilaiModel;
    protected $kelasModel;
    protected $guruModel;
    protected $mapelModel;
    protected $siswaModel;
    protected $pasModel;
    protected $typeTestModel;

    public function __construct(){
        $this->nilaiModel = new NilaiModel();
        $this->kelasModel = new KelasModel();
        $this->guruModel = new GuruModel();
        $this->mapelModel = new MapelModel();
        $this->siswaModel = new SiswaModel();
        $this->pasModel = new PASModel();
        $this->typeTestModel = new TypeTestModel();
    }
    public function index()
    {
        
        $data['nilai_pas'] = $this->pasModel
            ->join('kelas','kelas.id_kelas = nilai_pas.id_kelas')
            ->join('mapel','mapel.id_mapel = nilai_pas.id_mapel')
            ->join('guru','guru.id_guru = nilai_pas.id_guru')
            ->groupBy('nilai_pas.id_kelas')
            ->groupBy('nilai_pas.id_mapel')
            ->findAll();
            // dd($data);
        $data['kelas'] = $this->kelasModel->findAll();
        $data['guru'] = $this->guruModel->findAll();
        $data['mapel'] = $this->mapelModel->findAll();
        echo view('admin/template_admin/header');
        echo view('admin/template_admin/sidebar');
        echo view('admin/pas', $data);
        echo view('admin/template_admin/footer');
    }
    public function detail(){
        $dataInput = $this->request->getVar();
        $kelas = $dataInput['id_kelas'];
        $siswa = $this->siswaModel
            ->join('nilai_pas','siswa.id_siswa = nilai_pas.id_siswa','left')
            ->join('mapel','mapel.id_mapel = nilai_pas.id_mapel','left')
            ->join('kelas','kelas.id_kelas = nilai_pas.id_kelas','left')
            ->where('kelas.id_kelas',$dataInput['id_kelas'])
            ->where('mapel.id_mapel',$dataInput['id_mapel'])
            ->findAll();
            $data['kelas'] = $this->kelasModel->findAll();
            $data['guru'] = $this->guruModel->findAll();
            $data['mapel'] = $this->mapelModel->findAll();

            echo view('admin/template_admin/header');
            echo view('admin/template_admin/sidebar');
            echo view('admin/detail_pas', $data);
            echo view('admin/template_admin/footer');
    }
}
