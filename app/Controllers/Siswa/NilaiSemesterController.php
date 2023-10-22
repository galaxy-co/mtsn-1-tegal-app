<?php

namespace App\Controllers\Siswa;
use App\Models\Admin\PASModel;
use App\Models\Admin\SiswaModel;
use App\Models\Admin\KelasModel;
use App\Models\Admin\GuruModel;
use App\Controllers\BaseController;
use App\Models\Admin\SettingsModel;
use App\Database\Migrations\Kelas;

class NilaiSemesterController extends BaseController
{
    protected $pasModel;
    protected $siswaModel;
    protected $kelasModel;
    protected $guruModel;
    protected $settingModel;
    public function __construct()
    {
        $this->pasModel = new PASModel();
        $this->siswaModel = new SiswaModel();
        $this->kelasModel = new KelasModel();
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
        $siswaId = $siswa['id_siswa'];
        $kelasId = $siswa['kelas'];

        $kelas = $this->kelasModel->where('id_kelas', $kelasId)->first();
        $data['kurikulum'] = $kelas['kurikulum'];
        $idGuru = $kelas['id_guru'];

        $guru = $this->guruModel->where('id_guru', $idGuru)->first();
        $data['wali_kelas'] = $guru['nama_guru'];
        $cekNilaiPas = $this->pasModel->where('id_siswa', $siswaId)->findAll();
        $settings = $this->settingModel->first();
        $semester = $settings['semester'];
        $ta = $settings['tahun_ajaran'];

        if(count($cekNilaiPas) > 0){
            $data['nilai_pas'] = $this->pasModel
            ->join('siswa', 'siswa.id_siswa=nilai_pas.id_siswa')
            ->join('kelas', 'kelas.id_kelas=nilai_pas.id_kelas')
            ->join('rfmapel', 'rfmapel.id_rfmapel = nilai_pas.id_mapel')
            ->join('mapel', 'mapel.id_mapel = rfmapel.id_mapel')
            ->join('guru', 'guru.id_guru=nilai_pas.id_guru')
            ->where('nilai_pas.id_siswa', $siswaId)
            ->where('nilai_pas.semester', $semester)
            ->where('nilai_pas.tahun_ajaran', $ta)
            ->findAll();
        }else{
            $data['nilai_pas'] = [];
        }
        

            $groupedData = [];

            foreach ($data['nilai_pas'] as $s) {
                $semesterTahun = $s['semester'] . '-' . $s['tahun_ajaran'];
                if (!isset($groupedData[$semesterTahun])) {
                    $groupedData[$semesterTahun] = [];
                }
                $groupedData[$semesterTahun][] = $s;
            }
        $data['groupedData'] = $groupedData;
        echo view('admin/template_admin/header');
        echo view('admin/template_admin/sidebar_siswa', $data);
        echo view('siswa/nilaiSemester', $data);
        echo view('admin/template_admin/footer');
    }
}
