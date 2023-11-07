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
use App\Models\Admin\SettingsModel;
use App\Database\Migrations\Mapel;
use App\Models\Admin\UserModel;
use App\Models\Admin\RfMapelModel;

class PASController extends BaseController
{
    protected $rfMapelModel;
    protected $nilaiModel;
    protected $kelasModel;
    protected $guruModel;
    protected $mapelModel;
    protected $siswaModel;
    protected $pasModel;
    protected $typeTestModel;
    protected $settingsModel;
    protected $userModel;

    public function __construct(){
        $this->rfMapelModel = new RfMapelModel();
        $this->userModel = new UserModel();
        $this->nilaiModel = new NilaiModel();
        $this->kelasModel = new KelasModel();
        $this->guruModel = new GuruModel();
        $this->mapelModel = new MapelModel();
        $this->siswaModel = new SiswaModel();
        $this->pasModel = new PASModel();
        $this->typeTestModel = new TypeTestModel();
        $this->settingsModel = new SettingsModel();
    }
    public function index()
    {
        $session = session();
        $data['role_id'] = $session->get('role_id');
       

        if($data['role_id'] == 1){
            $data['kelas'] = $this->kelasModel->findAll();
        }else{
            $nuptk = $session->get('username');
            $Guru = $this->guruModel->where('nuptk', $nuptk)->first();
            $idGuru = $Guru['id_guru'];
            $rfResults = $this->rfMapelModel->where('id_guru', $idGuru)->findAll();
            if(!empty($rfResults)){
                $idKelasArray = [];

                foreach ($rfResults as $result) {
                    $idKelas = $result['id_kelas'];
                    $idKelasArray[] = $idKelas;
                }
                
                $dataKelas = $this->kelasModel->whereIn('id_kelas', $idKelasArray)->findAll();
            }
            
            
            if(!empty($dataKelas)){
                $data['kelas'] = $dataKelas;
            }else{
                $data['kelas'] = [];
            }
            
        }
        echo view('admin/template_admin/header');
        echo view('admin/template_admin/sidebar');
        echo view('admin/indexPas', $data);
        echo view('admin/template_admin/footer');
    }

    // public function index()
    // {
    //     $session = session();
    //     $data['role_id'] = $session->get('role_id');
    //     $nuptk = $session->get('username');
    //     $Guru = $this->guruModel->where('nuptk', $nuptk)->first();
    //     $idGuru = $Guru['id_guru'];
    //     $cekPas = $this->pasModel->findAll();
    //     if(count($cekPas)>0){
    //         $data['nilai_pas'] = $this->pasModel
    //         ->join('kelas','kelas.id_kelas = nilai_pas.id_kelas')
    //         ->join('mapel','mapel.id_mapel = nilai_pas.id_mapel')
    //         ->join('guru','guru.id_guru = nilai_pas.id_guru')
    //         ->where('guru.id_guru', $idGuru)
    //         ->groupBy('nilai_pas.tahun_ajaran')
    //         ->groupBy('nilai_pas.semester')
    //         ->groupBy('nilai_pas.id_kelas')
    //         ->groupBy('nilai_pas.id_mapel')
    //         ->findAll();
    //     }else{
    //         $data['nilai_pas'] = [];
    //     }
        
    //     $data['kelas'] = $this->kelasModel->findAll();
    //     $data['guru'] = $this->guruModel->findAll();
    //     $data['mapel'] = $this->mapelModel->findAll();
    //     echo view('admin/template_admin/header');
    //     echo view('admin/template_admin/sidebar');
    //     echo view('admin/pas', $data);
    //     echo view('admin/template_admin/footer');
    // }
    public function pasnilai($idkelas)
    {
        $settings = $this->settingsModel->first();
        $semester = $settings['semester'];
        $ta = $settings['tahun_ajaran'];
        $session = session();
        $data['role_id'] = $session->get('role_id');
       
        $data['id_kelas'] = $idkelas;
        if($data['role_id'] == 1){
            $mapel = $this->rfMapelModel
                                        ->join('mapel', 'mapel.id_mapel=rfmapel.id_mapel')
                                        ->where('id_kelas', $idkelas)->findAll();
                                        $data['mapel'] = $mapel;
            $nilai = $this->pasModel
            ->join('rfmapel', 'rfmapel.id_rfmapel = nilai_pas.id_mapel')
            ->join('mapel', 'mapel.id_mapel = rfmapel.id_mapel')
            ->where('nilai_pas.id_kelas', $idkelas)
            ->where('nilai_pas.semester', $semester)
            ->where('nilai_pas.tahun_ajaran', $ta)
            ->groupBy('nilai_pas.tahun_ajaran')
            ->groupBy('nilai_pas.semester')
            ->groupBy('nilai_pas.id_kelas')
            ->groupBy('nilai_pas.id_mapel')
            ->findAll();
        }else{
            $nuptk = $session->get('username');
            $Guru = $this->guruModel->where('nuptk', $nuptk)->first();
            $idGuru = $Guru['id_guru'];
            $data['mapel'] = $this->rfMapelModel
                                        ->join('mapel', 'mapel.id_mapel=rfmapel.id_mapel')
                                        ->where('id_kelas', $idkelas)
                                        ->where('id_guru', $idGuru)->findAll();

            $nilai = $this->pasModel
            ->join('rfmapel', 'rfmapel.id_rfmapel = nilai_pas.id_mapel')
            ->join('mapel', 'mapel.id_mapel = rfmapel.id_mapel')
            ->where('nilai_pas.id_guru', $idGuru)
            ->where('nilai_pas.id_kelas', $idkelas)
            ->where('nilai_pas.semester', $semester)
            ->where('nilai_pas.tahun_ajaran', $ta)
            ->groupBy('nilai_pas.tahun_ajaran')
            ->groupBy('nilai_pas.semester')
            ->groupBy('nilai_pas.id_kelas')
            ->groupBy('nilai_pas.id_mapel')
            ->findAll();
                        
        }
        
            
            if(!empty($nilai)){
            $data['nilaipas'] = $nilai;
            }else{
            $data['nilaipas'] = [];
            }
        echo view('admin/template_admin/header');
        echo view('admin/template_admin/sidebar');
        echo view('admin/pas', $data);
        echo view('admin/template_admin/footer');
    }
    public function detail(){
        $session = session();
        $data['role_id'] = $session->get('role_id');
        $dataInput = $this->request->getVar();
        $data['input'] = $dataInput;

        
        // $cekSiswa = $this->pasModel->where
            $kelas = $this->kelasModel->where('id_kelas', $dataInput['id_kelas'])->first();
            $kurikulum = $kelas['kurikulum'];
            $siswa = $this->siswaModel
                ->where('kelas', $dataInput['id_kelas'])
                ->orderBy('siswa.nama_siswa')
                ->findAll();
         
            // var_dump($siswa); die;
            // $data['kelas'] = $this->kelasModel->where('id_kelas', $dataInput['id_kelas'])->first();
            // $data['guru'] = $this->guruModel->where('id_guru', $dataInput['id_guru'])->first();
            // $data['mapel'] = $this->mapelModel->where('id_mapel', $dataInput['id_mapel'])->first();
            $data['siswa'] = $siswa;
            $data['mapel'] = $this->rfMapelModel
                                ->join('mapel', 'mapel.id_mapel=rfmapel.id_mapel')
                                ->join('kelas', 'kelas.id_kelas=rfmapel.id_kelas')
                                ->join('guru', 'guru.id_guru = rfmapel.id_guru')
                                ->where('rfmapel.id_kelas', $dataInput['id_kelas'])
                                ->where('rfmapel.id_mapel', $dataInput['id_mapel'] )
                                ->first();
            echo view('admin/template_admin/header');
            echo view('admin/template_admin/sidebar');
            echo view('admin/detail_pas', $data);
            echo view('admin/template_admin/footer');
    }
    public function store()
    {
        

        $idGuru = $this->request->getPost('id_guru');
        $idKelas = $this->request->getPost('id_kelas');
        $idMapel = $this->request->getPost('id_mapel');
        $role = $this->request->getPost('role_id');


        $setting = $this->settingsModel->first();
        $semester = $setting['semester'];
        $ta = $setting['tahun_ajaran'];

        $array_idSiswa = $this->request->getPost('id_siswa');
        $array_nilai = $this->request->getPost('nilai');
        $existingData = $this->pasModel->where('id_kelas', $idKelas)
                                    ->where('semester', $semester)
                                    ->where('tahun_ajaran', $ta)
                                    ->where('id_mapel', $idMapel)
                                    ->findAll();
        if($existingData){
            if($role == 1){
                session()->setFlashdata('warning', 'Data Sudah Tersedia!');
                return redirect()->to('/admin/pas');
            }else{
                session()->setFlashdata('warning', 'Data Sudah Tersedia!');
                return redirect()->to('/guru/pas');
            }
        }

        foreach ($array_idSiswa as $key => $id_siswa) {
            $data = [
                'id_guru' => $idGuru,
                'id_kelas' => $idKelas,
                'id_mapel' => $idMapel,
                'id_siswa' => $id_siswa,
                'nilai' => $array_nilai[$key],
                'type_test' => 1,
                'semester' => $semester,
                'tahun_ajaran' => $ta
            ];
    
            $this->pasModel->save($data);
        }
        
        session()->setFlashdata('success', 'Nilai Berhasil Disimpan');
        if($role == 1){
            return redirect()->to('/admin/pas');
        }else{
            return redirect()->to('/guru/pas');
        }
        
        
    }
    public function generateNilai($input, $data){
        $settings = $this->settingsModel->first();
        $kelas = $input['id_kelas'];
        $guru = $input['id_guru'];
        $mapel = $input['id_mapel'];
        $semester = $settings['semester'];
        $ta = $settings['tahun_ajaran'];
        $array_idSiswa = $data['siswa'];
    
        foreach ($array_idSiswa as $siswa) {
            $nilaiData = [
                'id_guru' => $guru,
                'id_kelas' => $kelas,
                'id_mapel' => $mapel,
                'id_siswa' => $siswa['id_siswa'],
                'nilai' => null,
                'type_test' => 1,
                'semester' => $semester,
                'tahun_ajaran' => $ta
            ];
            $this->pasModel->insert($nilaiData);
        }


    }
    
    public function regenerate(){
        $inputPost = $this->request->getVar();
        $settings = $this->settingsModel->first();
        $semester = $settings['semester'];
        $ta = $settings['tahun_ajaran'];
        $data['allSiswa'] =$this->siswaModel->where('kelas',$inputPost['id_kelas'])->findAll();
        $cekPas = $this->pasModel->where('id_mapel', $inputPost['id_mapel'])
                        ->where('id_kelas', $inputPost['id_kelas'])
                        ->where('id_guru', $inputPost['id_guru'])
                        ->where('semester', $semester)
                        ->where('tahun_ajaran', $ta)
                        ->findAll();
        
        $existingStudentIds = array_column($cekPas, 'id_siswa');

        $missingStudents = array_filter($data['allSiswa'], function($siswa) use ($existingStudentIds) {
            return !in_array($siswa['id_siswa'], $existingStudentIds);
        });
        $data['siswa'] = $missingStudents;
        if($missingStudents){
            $this->generateNilai($inputPost,$data);
            session()->setFlashdata('success', 'Berhasil Generate Data');
            return redirect()->to('admin/pas/pasnilai/' . $inputPost['id_kelas']);
        }else{
            session()->setFlashdata('warning', 'Tidak Ada Data Yang Perlu Di Generate Ulang');
            return redirect()->to('admin/pas/pasnilai/' . $inputPost['id_kelas']);
        }
    }
    public function edit($id){
        $nilai = $this->pasModel->where('id_nilai_pas', $id)->first();

        $kelas = $nilai['id_kelas'];
        $mapel = $nilai['id_mapel'];
        $semester = $nilai['semester'];
        $ta = $nilai['tahun_ajaran'];

        $data['nilai_pas'] = $this->pasModel
                            ->join('kelas', 'kelas.id_kelas = nilai_pas.id_kelas')
                            ->join('siswa', 'siswa.id_siswa = nilai_pas.id_siswa')
                            ->join('rfmapel', 'rfmapel.id_rfmapel = nilai_pas.id_mapel')
                            ->join('mapel', 'mapel.id_mapel = rfmapel.id_mapel')
                            ->join('guru', 'guru.id_guru = nilai_pas.id_guru')
                            ->where('nilai_pas.semester', $semester)
                            ->where('nilai_pas.tahun_ajaran', $ta)
                            ->where('nilai_pas.id_kelas', $kelas)
                            ->where('nilai_pas.id_mapel', $mapel)
                            ->orderBy('siswa.nama_siswa')
                            ->findAll();
        $data['kelas'] = $kelas;
        $data['mapel'] = $mapel;
        $data['guru'] =  $nilai['id_mapel'];
        echo view('admin/template_admin/header');
        echo view('admin/template_admin/sidebar');
        echo view('admin/edit_pas', $data);
        echo view('admin/template_admin/footer');

    }

    public function update()
    {
        $array_idNilaiPas = $this->request->getPost('id_nilai_pas');
        $array_nilai = $this->request->getPost('nilai');
 

        foreach($array_idNilaiPas as $key => $idNilaiPas){
            $data = [
                'nilai' => $array_nilai[$key]
            ];
            $this->pasModel->update($idNilaiPas, $data);
        }
        session()->setFlashdata('success', 'Update NIlai');

        return redirect()->to('/admin/pas');
        
    }
}
