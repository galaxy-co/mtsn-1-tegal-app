<?php

namespace App\Controllers\Siswa;
use App\Models\Admin\NilaiKetrampilanModel;
use App\Models\Admin\KelasModel;
use App\Models\Admin\GuruModel;
use App\Models\Admin\MapelModel;
use App\Models\Admin\SiswaModel;
use App\Models\Admin\NilaiKetrampilanDetailModel;
use App\Models\Admin\RFNilaiKetrampilanDetailModel;
use App\Models\Admin\SettingsModel;
use App\Controllers\BaseController;

class NilaiKetrampilanController extends BaseController
{
    protected $nilaiModel;
    protected $kelasModel;
    protected $guruModel;
    protected $mapelModel;
    protected $siswaModel;
    protected $nilaiDetailModel;
    protected $rfNilaiDetailModel;
    protected $settings;
    public function __construct(){
        $this->nilaiModel = new NilaiKetrampilanModel();
        $this->kelasModel = new KelasModel();
        $this->guruModel = new GuruModel();
        $this->mapelModel = new MapelModel();
        $this->siswaModel = new SiswaModel();
        $this->nilaiDetailModel = new NilaiKetrampilanDetailModel();
        $this->rfNilaiDetailModel = new RFNilaiKetrampilanDetailModel();
        $this->settings = new SettingsModel();
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
    $kurikulum = $kelas['kurikulum'];
    $setting = $this->settings->first();
    $semester = $setting['semester'];
    $ta = $setting['tahun_ajaran'];
    $data['kurikulum'] = $kurikulum;
    $data['rf_nilai_detail'] = $this->rfNilaiDetailModel->where('kurikulum_id', $kurikulum)->orderBy('rf_nilai_detail_id')->findAll();
    $nilai = $this->nilaiModel->where('id_siswa', $siswaId)->find();
    $idNilai = [];

    foreach ($nilai as $n) {
        array_push($idNilai, $n['id_nilai']);
    }

    $data['kelas'] = $this->kelasModel->findAll();
    $data['guru'] = $this->guruModel->findAll();
    $data['mapel'] = $this->mapelModel->findAll();

    $data['header'] = [];
    $data['nilai_detail'] = [];

    if (count($idNilai) > 0) {
        $data['nilai_detail'] = $this->nilaiDetailModel->whereIn('id_nilai', $idNilai)->findAll();

        $data['nilai'] = $this->nilaiModel
            ->join('kelas', 'kelas.id_kelas = nilaiKetrampilan.id_kelas')
            ->join('mapel', 'mapel.id_mapel = nilaiKetrampilan.id_mapel')
            ->join('guru', 'guru.id_guru = nilaiKetrampilan.id_guru')
            ->join('nilaiKetrampilanDetail', 'nilaiKetrampilanDetail.id_nilai = nilaiKetrampilan.id_nilai')
            ->whereIn('nilaiKetrampilan.id_nilai', $idNilai)
            ->where('nilaiKetrampilan.semester', $semester)
            ->where('nilaiKetrampilan.tahun_ajaran', $ta)
            ->groupBy('nilaiKetrampilan.id_kelas')
            ->groupBy('nilaiKetrampilan.id_mapel')
            ->findAll();

        foreach($data['nilai_detail'] as $nilai_detail){
            $cek = 0;
            $index = 0;
            for ($i=0; $i < count($data['header']) ; $i++) { 
                $z=$data['header'][$i];
                if($nilai_detail['kd_name'] == $z['kd_name']){
                    $cek ++;
                    $index = $i;
                    break;
                }
            } 
            
            if(!$cek){
                array_push($data['header'],[
                    "kd_name" => $nilai_detail['kd_name'],
                    "nilai_detail_ids" => [$nilai_detail['nilai_detail_id']]
                ]);
            }else{
                array_push($data['header'][$index]['nilai_detail_ids'],$nilai_detail['nilai_detail_id']);
            }
        }
    } else {
        $data['nilai'] = []; 
    }

    $groupedData = [];
    foreach ($data['nilai'] as $s) {
        $semesterTahun = $s['semester'] . '-' . $s['tahun_ajaran'];
        if (!isset($groupedData[$semesterTahun])) {
            $groupedData[$semesterTahun] = [];
        }
        $groupedData[$semesterTahun][] = $s;
    }
    $data['groupedData'] = $groupedData;
    // dd($data);

    echo view('admin/template_admin/header');
    echo view('admin/template_admin/sidebar_siswa', $data);
    echo view('siswa/nilaiKetrampilan', $data);
    echo view('admin/template_admin/footer');
}
}
