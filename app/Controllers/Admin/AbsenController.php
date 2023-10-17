<?php

namespace App\Controllers\Admin;
use App\Models\Admin\AbsenModel;
use App\Models\Admin\KelasModel;
use App\Models\Admin\SiswaModel;
use App\Controllers\BaseController;
use App\Models\Admin\SettingsModel;
use App\Models\Admin\UserModel;

class AbsenController extends BaseController
{
    protected $absenModel;
    protected $kelasModel;
    protected $siswaModel;
    protected $settingsModel;
    protected $userModel;
    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->absenModel = new AbsenModel();
        $this->kelasModel = new KelasModel();
        $this->siswaModel = new SiswaModel();
        $this->settingsModel = new SettingsModel();
    }

    public function index()
    {
        $session = session();
        $data['role_id'] = $session->get('role_id');
        $data['kelas'] = $this->kelasModel->findAll();
        echo view('admin/template_admin/header');
        echo view('admin/template_admin/sidebar', $data);
        echo view('admin/absen', $data);
        echo view('admin/template_admin/footer');
    }
    public function dataSiswa($id_kelas)
    {
        $session = session();
        $data['role_id'] = $session->get('role_id');
        $data['siswa'] = $this->siswaModel->select('sum(absen.sakit) as sakit, sum(absen.izin) as izin, sum(absen.alpa) as alpa, siswa.*')
                        ->join('absen', 'absen.id_siswa=siswa.id_siswa', 'left')
                        ->join('settings', 'settings.semester=absen.semester AND settings.tahun_ajaran = absen.tahun_ajaran','left')
                        ->where('kelas', $id_kelas)

                        ->groupBy('siswa.id_siswa')->findAll();
        if(!empty($data['siswa'])){
            $id_siswa = array();

            foreach ($data['siswa'] as $siswa) {
                $id_siswa[] = $siswa['id_siswa'];
            }
            $absensi = $this->absenModel->whereIn('id_siswa', $id_siswa)->findAll();
            $data['absensi'] = $absensi;
        }
        
        echo view('admin/template_admin/header');
        echo view('admin/template_admin/sidebar', $data);
        echo view('admin/dataSiswa', $data);
        echo view('admin/template_admin/footer');
    }
    public function addAbsen($id_siswa)
    {
        $session = session();
        $data['role_id'] = $session->get('role_id');
        $data['id_siswa'] = $id_siswa;
        $data['absen']=$this->absenModel
                        ->join('settings', 'settings.semester=absen.semester AND settings.tahun_ajaran = absen.tahun_ajaran')->where('id_siswa',$id_siswa)->findAll();
        echo view('admin/template_admin/header');
        echo view('admin/template_admin/sidebar');
        echo view('admin/addAbsen', $data);
        echo view('admin/template_admin/footer');
    }
    public function add(){
        $siswa = $this->request->getPost('id_siswa');
        $kelas = $this->siswaModel->where('id_siswa', $siswa)->first();
        $idKelas = $kelas['kelas'];
        $izin = $this->request->getPost('izin');
        $sakit = $this->request->getPost('sakit');
        $alpa = $this->request->getPost('alpa');
        $catatan = $this->request->getPost('catatan');

        $setting = $this->settingsModel->first();
        $semester = $setting['semester'];
        $ta = $setting['tahun_ajaran'];
        $data = [
            'id_absen' => $this->request->getPost('id_absen'),
            'id_siswa' => $siswa,
            'izin' => $izin,
            'sakit'=> $sakit,
            'alpa' => $alpa,
            'catatan' => $catatan,
            'semester' => $semester,
            'tahun_ajaran' => $ta
        ];

        

        $this->absenModel->save($data);
        session()->setFlashdata('success', 'Input Absen');

        return redirect()->to('/admin/absen/dataSiswa/' . $idKelas);
    }
    public function edit($id){
        $data['absen'] = $this->absenModel->find($id);
        echo view('admin/template_admin/header');
        echo view('admin/template_admin/sidebar');
        echo view('admin/editAbsen', $data);
        echo view('admin/template_admin/footer');
    }
    public function update($id){
        $siswa = $this->request->getPost('id_siswa');
        $kelas = $this->siswaModel->where('id_siswa', $siswa)->first();
        $idKelas = $kelas['kelas'];
       
        
        $data = $this->request->getPost();
        $this->absenModel->update($id, $data);
        session()->setFlashdata('success', 'Update Absen');

        return redirect()->to('/admin/absen/dataSiswa/' . $idKelas);
    }
    public function historyAbsen($id){
        $data['absen']=$this->absenModel->select('sum(absen.sakit) as sakit, sum(absen.izin) as izin, sum(absen.alpa) as alpa,absen.semester, absen.tahun_ajaran')
        ->join('settings', 'settings.semester=absen.semester AND settings.tahun_ajaran = absen.tahun_ajaran','left')
        ->where('absen.id_siswa', $id)
        ->groupBy('absen.semester')
        ->groupBy('absen.tahun_ajaran')
        ->findAll();
        echo view('admin/template_admin/header');
        echo view('admin/template_admin/sidebar');
        echo view('admin/history_absen', $data);
        echo view('admin/template_admin/footer');
    }
}
