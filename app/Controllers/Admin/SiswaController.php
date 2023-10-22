<?php

namespace App\Controllers\Admin;
use App\Models\Admin\SiswaModel;
use App\Models\Admin\KelasModel;
use App\Models\Admin\UserModel;
use App\Models\Admin\NilaiModel;
use App\Models\Admin\NilaiDetailModel;
use App\Models\Admin\GuruModel;
use App\Models\Admin\MapelModel;
use App\Models\Admin\RFNilaiDetailModel;
use App\Models\Admin\NilaiKetrampilanModel;
use App\Models\Admin\NilaiKetrampilanDetailModel;
use App\Models\Admin\RFNilaiKetrampilanDetailModel;
use App\Controllers\BaseController;
use App\Models\Admin\PASModel;

class SiswaController extends BaseController
{
    protected $siswaModel;
    protected $kelasModel;
    protected $userModel;
    protected $mapelModel;
    protected $guruModel;
    // nilaiPengetahuan
    protected $nilaiModel;
    protected $nilaiDetailModel;
    protected $rfNilaiDetailModel;
    // nilaiKetrampilan
    protected $nilaiKetrampilan;
    protected $nilaiKetrampilanDetail;
    protected $rfNilaiKetrampilanDetail;

    // pas
    protected $pasModel;
    public function __construct()
    {
        $this->siswaModel = new SiswaModel();
        $this->kelasModel = new KelasModel();
        $this->userModel = new UserModel();
        $this->mapelModel = new MapelModel();
        $this->guruModel = new GuruModel();
        // nilaiPengetahuan
        $this->nilaiModel = new NilaiModel();
        $this->nilaiDetailModel = new NilaiDetailModel();
        $this->rfNilaiDetailModel = new RFNilaiDetailModel();
        // nilaiKetrampilan
        $this->nilaiKetrampilan = new NilaiKetrampilanModel();
        $this->nilaiKetrampilanDetail = new NilaiKetrampilanDetailModel();
        $this->rfNilaiKetrampilanDetail = new RFNilaiKetrampilanDetailModel();

        // pas
        $this->pasModel = new PASModel();

        
    }
    public function index()
    {
        $siswa = $this->siswaModel->where('kelas !=', 0)->findAll();
        // $data['siswa_kelas'] = [];
        $data['siswa_kelas'] = $this->siswaModel
            ->join('kelas', 'kelas.id_kelas = siswa.kelas','left')
            ->findAll();
        // foreach ($siswa as $row) {
        //     $kelas = $this->kelasModel->where('id_kelas', $row['kelas'])->first();
        //     // var_dump($kelas); die;
        //     $data['siswa_kelas'][] = [
        //         'nama_siswa' => $row['nama_siswa'],
        //         'nama_kelas' => $kelas['nama_kelas'],
        //         'nism' => $row['nism'],
        //         'jenis_kelamin' => $row['jenis_kelamin'],
        //         'id_siswa' => $row['id_siswa'],
        //         'tingkat' => $kelas['tingkat']
                
        //     ];
        // }
        $data['kelas'] = $this->kelasModel->findAll();
        echo view('admin/template_admin/header');
        echo view('admin/template_admin/sidebar');
        echo view('admin/siswa_in_admin', $data);
        echo view('admin/template_admin/footer');
    }
    public function addSiswa()
    {
        $nism = $this->request->getPost('nism');
        $existingSiswa = $this->siswaModel->where('nism', $nism)->first();
        if($existingSiswa){
            session()->setFlashdata('warning', 'NISM sudah terdaftar');

            return redirect()->to('/admin/siswa');
        }
        $data = $this->request->getPost();
        $password = $this->request->getPost('nism');
        $dataToUser = [
            'username' => $this->request->getPost('nism'),
            'name' => $this->request->getPost('nama_siswa'),
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'role_id' => 2
        ];

        $this->siswaModel->save($data);
        $this->userModel->save($dataToUser);
        session()->setFlashdata('success', 'Siswa Di Tambahkan');

        return redirect()->to('/admin/siswa');
    }
    public function delete($id){
        $id = intval($id);
        $siswa = $this->siswaModel->where('id_siswa', $id)->first();
        $nism = $siswa['nism'];
        $user = $this->userModel->where('username', $nism)->first();
        $userId = $user['user_id'];
       
        $this->siswaModel->delete($id);
        $this->userModel->delete($userId);

        session()->setFlashdata('success', 'Sukses Hapus Data');

        return redirect()->to('/admin/siswa');
    }
    public function upload(){
        $file = $this->request->getFile('upload_guru');
        $extention = $file->getClientExtension();
        $kelas = $this->kelasModel->findAll();

        $dataArraySiswa=[];
        $dataArrayUser=[];
        if($extention == 'xls' || $extention == 'xlsx'){
            if($extention == 'xls'){
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
            }else{
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            }
            $spreadSheet = $reader->load($file);
            $guru = $spreadSheet->getActiveSheet()->toArray();
            foreach($guru as $g => $value){
                
                if($g == 0){
                    continue;
                    
                }else{
                    $existingSiswa = $this->siswaModel->where('nism', $value[1])->first();
                    if ($existingSiswa) {
  
                        session()->setFlashdata('warning', 'Ada data NISM yang sudah terdaftar');
                        return redirect()->to('/admin/siswa');
                    }
                    $kelasId = null;
                    $kelasValue = $value[5];
                    $cek = 0;
                    foreach ($kelas as $k) {
                        $kelasNama = $k['tingkat']." ".$k['nama_kelas'];
                        
                        if (strtolower(preg_replace('/\s+/', '', $kelasNama)) == strtolower(preg_replace('/\s+/', '', $kelasValue))) {
                            
                            $kelasId = $k['id_kelas']; 
                            $value[5] = $kelasId;
                            $cek++;
                            break; 
                            
                        }
                    }
                    if($cek == 0){
                        session()->setFlashdata('warning', "Kelas $kelasValue belum terdaftar! Silahkan input Kelas terlebih dahulu!");
                        return redirect()->to('/admin/siswa');
                    }
                    $data = [
                        'nism' => $value[1],
                        'nisn' => $value[2],
                        'nama_siswa' => $value[3],
                        'jenis_kelamin' => $value[4],
                        'kelas' => $value[5]
                    ];
                    $dataToUsers = [
                        'username' => $value[1],
                        'name' => $value[3],
                        'password' => password_hash($value[1], PASSWORD_DEFAULT),
                        'role_id' => 2
                    ];

                    array_push($dataArraySiswa,$data);
                    array_push($dataArrayUser,$dataToUsers);
                    
                }
            }

            // dd($dataArraySiswa,$dataArrayUser);
            $this->siswaModel->insertBatch($dataArraySiswa);
            $this->userModel->insertBatch($dataArrayUser);
           
            session()->setFlashdata('success', 'Berhasil Upload Siswa');
            return redirect()->to('/admin/siswa');
        }else{
            session()->setFlashdata('warning', 'Ekstensi File Tidak di Izinkan');
            return redirect()->to('/admin/siswa');
        }
        
    }
    public function edit($id){
        $data['kelas'] = $this->kelasModel->findAll();
        $data['siswa'] = $this->siswaModel->find($id);
       

        echo view('admin/template_admin/header');
        echo view('admin/template_admin/sidebar');
        echo view('admin/edit_siswa', $data);
        echo view('admin/template_admin/footer');
    }
    public function update($id){
        // $nism = $this->request->getPost('nism');
        // $existingSiswa = $this->siswaModel->where('nism', $nism)->first();
        // if($existingSiswa){
        //     session()->setFlashdata('warning', 'NISM sudah terdaftar');

        //     return redirect()->to('/admin/siswa');
        // }
        $data = $this->request->getPost();
        $this->siswaModel->update($id, $data);
        session()->setFlashdata('success', 'Update Siswa');

        return redirect()->to('/admin/siswa');
    }
    public function historyNilai ($idSiswa){
        $data['id_siswa'] = $idSiswa;
        echo view('admin/template_admin/header');
        echo view('admin/template_admin/sidebar');
        echo view('admin/historyNilai', $data);
        echo view('admin/template_admin/footer');
    }
    public function nilaiPengetahuan($id){
        $data['type'] = 'Pengetahuan';
        $siswa = $this->siswaModel->where('id_siswa', $id)->first();
        $siswaId = $siswa['id_siswa'];
        $kelasId = $siswa['kelas'];
        $kelas = $this->kelasModel->where('id_kelas', $kelasId)->first();
        $kurikulum = $kelas['kurikulum'];
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
                ->join('kelas', 'kelas.id_kelas = nilai.id_kelas')
                ->join('mapel', 'mapel.id_mapel = nilai.id_mapel')
                ->join('guru', 'guru.id_guru = nilai.id_guru')
                ->join('nilai_detail', 'nilai_detail.id_nilai = nilai.id_nilai')
                ->whereIn('nilai.id_nilai', $idNilai)
                ->groupBy('nilai.id_mapel')
                ->groupBy('nilai.semester')
                ->groupBy('nilai.tahun_ajaran')
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
    
        echo view('admin/template_admin/header');
        echo view('admin/template_admin/sidebar');
        echo view('admin/detailHistory', $data);
        echo view('admin/template_admin/footer');
    }
    public function nilaiKetrampilan($id){
        $data['type'] = 'Ketrampilan';
        $siswa = $this->siswaModel->where('id_siswa', $id)->first();
        $siswaId = $siswa['id_siswa'];
        $kelasId = $siswa['kelas'];
        $kelas = $this->kelasModel->where('id_kelas', $kelasId)->first();
        $kurikulum = $kelas['kurikulum'];
        $data['kurikulum'] = $kurikulum;

        $data['rf_nilai_detail'] = $this->rfNilaiKetrampilanDetail->where('kurikulum_id', $kurikulum)->orderBy('rf_nilai_detail_id')->findAll();
        $nilai = $this->nilaiKetrampilan->where('id_siswa', $siswaId)->find();
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
            $data['nilai_detail'] = $this->nilaiKetrampilanDetail->whereIn('id_nilai', $idNilai)->findAll();
            $cekNilaiKet = $this->nilaiKetrampilan->whereIn('nilaiKetrampilan.id_nilai', $idNilai)->findAll();
            // dd($cekNilaiKet);
            $data['nilai'] = $this->nilaiKetrampilan
                ->join('kelas', 'kelas.id_kelas = nilaiKetrampilan.id_kelas')
                ->join('mapel', 'mapel.id_mapel = nilaiKetrampilan.id_mapel')
                ->join('guru', 'guru.id_guru = nilaiKetrampilan.id_guru')
                ->join('nilaiKetrampilanDetail', 'nilaiKetrampilanDetail.id_nilai = nilaiKetrampilan.id_nilai')
                ->whereIn('nilaiKetrampilan.id_nilai', $idNilai)
                ->groupBy('nilaiKetrampilan.id_mapel')
                ->groupBy('nilaiKetrampilan.semester')
                ->groupBy('nilaiKetrampilan.tahun_ajaran')
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
        // dd($data['nilai']);
        $groupedData = [];
        foreach ($data['nilai'] as $s) {
            $semesterTahun = $s['semester'] . '-' . $s['tahun_ajaran'];
            if (!isset($groupedData[$semesterTahun])) {
                $groupedData[$semesterTahun] = [];
            }
            $groupedData[$semesterTahun][] = $s;
        }
        // dd($groupedData);
        $data['groupedData'] = $groupedData;
    
        echo view('admin/template_admin/header');
        echo view('admin/template_admin/sidebar');
        echo view('admin/detailHistory', $data);
        echo view('admin/template_admin/footer');
    }
    public function nilaiPas($id){
        $data['type'] = 'PAS';
        $siswa = $this->siswaModel->where('id_siswa', $id)->first();
        $siswaId = $siswa['id_siswa'];
        $kelasId = $siswa['kelas'];

        $kelas = $this->kelasModel->where('id_kelas', $kelasId)->first();
        $data['kurikulum'] = $kelas['kurikulum'];
        $idGuru = $kelas['id_guru'];

        $guru = $this->guruModel->where('id_guru', $idGuru)->first();
        $data['wali_kelas'] = $guru['nama_guru'];
        $cekNilaiPas = $this->pasModel->where('id_siswa', $siswaId)->findAll();

        if(count($cekNilaiPas) > 0){
            $data['nilai_pas'] = $this->pasModel
            ->join('siswa', 'siswa.id_siswa=nilai_pas.id_siswa')
            ->join('kelas', 'kelas.id_kelas=nilai_pas.id_kelas')
            ->join('rfmapel', 'rfmapel.id_rfmapel = nilai_pas.id_mapel')
            ->join('mapel', 'mapel.id_mapel = rfmapel.id_mapel')
            ->join('guru', 'guru.id_guru=nilai_pas.id_guru')
            ->where('nilai_pas.id_siswa', $siswaId)
            ->groupBy('nilai_pas.semester')
            ->groupBy('nilai_pas.tahun_ajaran')
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
        echo view('admin/template_admin/sidebar');
        echo view('admin/historyPas', $data);
        echo view('admin/template_admin/footer');
    }
}
