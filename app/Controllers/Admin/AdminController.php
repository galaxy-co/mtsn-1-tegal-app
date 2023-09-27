<?php

namespace App\Controllers\Admin;
use App\Models\Admin\GuruModel;
use App\Models\Admin\AdminModel;
use App\Models\Admin\AbsenModel;
use App\Models\Admin\SiswaModel;
use App\Models\Admin\KelasModel;
use App\Models\Admin\MapelModel;
use App\Models\Admin\SettingsModel;
use App\Controllers\BaseController;

class AdminController extends BaseController
{
    protected $guruModel;
    protected $adminModel;
    protected $absenModel;
    protected $siswaModel;
    protected $kelasModel;
    protected $mapelModel;
    protected $settingModel;
    public function __construct()
    {
        $this->settingModel = new SettingsModel();
        $this->guruModel = new GuruModel();
        $this->absenModel = new AbsenModel();
        $this->siswaModel = new SiswaModel();
        $this->kelasModel = new KelasModel();
        $this->mapelModel = new MapelModel();
    }
    public function index()
    {
        $totalSiswa = $this->siswaModel->countAllResults();
        $totalKelas = $this->kelasModel->countAllResults();
        $totalMapel = $this->mapelModel->countAllResults();
        $totalGuru = $this->mapelModel->countAllResults();
        $data['settings'] = $this->settingModel->first();
        $data['jumlahSiswa'] = $totalSiswa;
        $data['jumlahKelas'] = $totalKelas;
        $data['jumlahMapel'] = $totalMapel;
        $data['jumlahGuru'] = $totalGuru;
        echo view('admin/template_admin/header');
        echo view('admin/template_admin/sidebar');
        echo view('admin/index', $data);
        echo view('admin/template_admin/footer');
    }
}
