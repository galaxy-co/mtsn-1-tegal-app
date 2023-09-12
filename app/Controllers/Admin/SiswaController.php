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
        $siswa = $this->siswaModel->findAll();
        $data['siswa_kelas'] = [];
        foreach ($siswa as $row) {
            $kelas = $this->kelasModel->where('id_kelas', $row['kelas'])->first();
            $data['siswa_kelas'][] = [
                'nama_siswa' => $row['nama_siswa'],
                'nama_kelas' => $kelas['nama_kelas'],
                'nism' => $row['nism'],
                'jenis_kelamin' => $row['jenis_kelamin'],
                'id_siswa' => $row['id_siswa'],
                'tingkat' => $kelas['tingkat']
                
            ];
        }
        $data['kelas'] = $this->kelasModel->findAll();
        echo view('admin/template_admin/header');
        echo view('admin/template_admin/sidebar');
        echo view('admin/siswa_in_admin', $data);
        echo view('admin/template_admin/footer');
    }
    public function addSiswa()
    {
        $data = $this->request->getPost();
        $dataToUser = [
            'username' => $this->request->getPost('nism'),
            'name' => $this->request->getPost('nama_siswa'),
            'password' =>$this->request->getPost('nism'),
            'role' => 2
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
                    $kelasId = null;
                    $kelasValue = $value[4];
                    foreach ($kelas as $k) {
                        $kelasNama = $k['tingkat'].$k['nama_kelas'];
                        
                        if (strtolower($kelasNama) == strtolower($kelasValue)) {
                            
                            $kelasId = $k['id_kelas']; 
                            $value[4] = $kelasId;
                            break; 
                            
                        }
                    }
                    $data = [
                        'nism' => $value[1],
                        'nama_siswa' => $value[2],
                        'jenis_kelamin' => $value[3],
                        'kelas' => $value[4]
                    ];
                    $dataToUsers = [
                        'username' => $value[1],
                        'name' => $value[2],
                        'password' => $value[1],
                        'role_id' => 2
                    ];
                    
                }
                $this->siswaModel->save($data);
                $this->userModel->save($dataToUsers);
            }
           
            session()->setFlashdata('success', 'Berhasil Upload Siswa');
            return redirect()->to('/admin/siswa');
        }else{
            session()->setFlashdata('warning', 'Ekstensi File Tidak di Izinkan');
            return redirect()->to('/admin/siswa');
        }
    }
}
