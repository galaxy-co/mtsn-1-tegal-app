<?php

namespace App\Controllers\Admin;
use App\Models\Admin\SiswaModel;
use App\Models\Admin\KelasModel;
use App\Models\Admin\UserModel;
use App\Controllers\BaseController;

class SiswaController extends BaseController
{
    protected $siswaModel;
    protected $kelasModel;
    protected $userModel;
    public function __construct()
    {
        $this->siswaModel = new SiswaModel();
        $this->kelasModel = new KelasModel();
        $this->userModel = new UserModel();
        
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
        
    }
    public function nilaiKetrampilan($id){
        
    }
    public function nilaiPas($id){
        
    }
}
