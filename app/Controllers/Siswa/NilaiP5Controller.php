<?php

namespace App\Controllers\Siswa;

use App\Controllers\BaseController;
use App\Models\Admin\KelasModel;
use App\Models\Admin\SiswaModel;
use App\Models\Admin\CapaianModel;
use App\Models\Admin\PenilaianP5Model;
use App\Models\Admin\ProyekModel;
use App\Models\Admin\ProjectDimensiModel;
use App\Models\Admin\RFNilaiP5Model;
use App\Models\Admin\GuruModel;
use App\Models\Admin\SettingsModel;

class NilaiP5Controller extends BaseController
{
    protected $kelasModel;
    protected $siswaModel;
    protected $capaianModel;
    protected $nilaiP5Model;
    protected $rfnilaip5model;
    protected $guruModel;
    protected $settingModel;
    public function __construct()
    {
        $this->nilaiP5Model = new PenilaianP5Model();
        $this->kelasModel = new KelasModel();
        $this->siswaModel = new SiswaModel();
        $this->capaianModel = new CapaianModel();
        $this->rfnilaip5model = new RFNilaiP5Model();
        $this->guruModel = new GuruModel();
        $this->settingModel = new SettingsModel();
    }

    public function index()
    {
        $session = session();
        $name = $session->get('name');
        $data['name'] = $name;
        $nism = $session->get('username');
        $siswa = $this->siswaModel->where('nism', $nism)->first();
        $idKelas = $siswa['kelas'];
        $kelas = $this->kelasModel->where('id_kelas', $idKelas)->first();
        $data['kurikulum'] = $kelas['kurikulum'];
        $idSiswa = $siswa['id_siswa'];

        $data['nilai'] = $this->nilaiP5Model->where('id_siswa', $idSiswa)->findAll();
        $data['rfnilai'] = $this->rfnilaip5model->findAll();

        $data['nilaip5'] = $this->nilaiP5Model
                        ->join('project_dimensi', 'project_dimensi.id_project_dimensi=nilaip5.id_project_dimensi')
                        ->join('projects', 'projects.id_project=project_dimensi.id_project')
                        ->join('rf_nilai_p5_options', 'rf_nilai_p5_options.id_nilaip5_option = nilaip5.nilai')
                        ->join('capaian_p5', 'capaian_p5.id_capaian=project_dimensi.kode_capaian_fase')
                        ->join('dimensi_p5', 'dimensi_p5.id_dimensi=project_dimensi.id_dimensi')
                        ->where('nilaip5.id_siswa', $idSiswa)
                        ->findAll();
        
                        $groupedData = [];

                        foreach ($data['nilaip5'] as $s) {
                            $semesterTahun = $s['semester'] . '-' . $s['tahun_ajaran'];
                            if (!isset($groupedData[$semesterTahun])) {
                                $groupedData[$semesterTahun] = [];
                            }
                            $groupedData[$semesterTahun][] = $s;
                        }
                    $data['groupedData'] = $groupedData;
        echo view('admin/template_admin/header');
        echo view('admin/template_admin/sidebar_siswa', $data);
        echo view('siswa/siswa_p5', $data);
        echo view('admin/template_admin/footer');
    }
}
