<?php

namespace App\Controllers\Admin;
use App\Models\Admin\GuruModel;
use App\Controllers\BaseController;
use App\Models\Admin\UserModel;


class GuruController extends BaseController
{
    protected $guruModel;
    protected $userModel;
    public function __construct()
    {
        $this->guruModel = new GuruModel();
        $this->userModel = new UserModel();
    }
    public function index()
    {
        $data['guru'] = $this->guruModel->findAll();
        echo view('admin/template_admin/header');
        echo view('admin/template_admin/sidebar');
        echo view('admin/guru_in_admin', $data);
        echo view('admin/template_admin/footer');
    }
    public function uploadGuru()
    {
        $file = $this->request->getFile('upload_guru');
        $extention = $file->getClientExtension();
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
                    $existingSiswa = $this->guruModel->where('nuptk', $value[1])->first();
                    if ($existingSiswa) {
  
                        session()->setFlashdata('warning', 'Ada data NIP yang sudah terdaftar');
                        return redirect()->to('/admin/guru');
                    }
                    $data = [
                        'nama_guru' => $value[1],
                        'nuptk' => $value[2]
                    ];
                    $dataToUsers = [
                        'username' => $value[2],
                        'name' => $value[1],
                        'password' => password_hash($value[2], PASSWORD_DEFAULT),
                        'role_id' => 3
                    ];
                }
                $this->guruModel->save($data);
                $this->userModel->save($dataToUsers);
            }
           
            session()->setFlashdata('success', 'Berhasil Upload Guru');
            return redirect()->to('/admin/guru');
        }else{
            session()->setFlashdata('warning', 'Ekstensi File Tidak di Izinkan');
            return redirect()->to('/admin/guru');
        }
    }
    public function deleteGuru($id){
        $id = intval($id);
        $guru = $this->guruModel->where('id_guru', $id)->first();
        
        $nip = $guru['nuptk'];
        $user = $this->userModel->where('username', $nip)->first();
        
        $userId = $user['user_id'];

        
        $this->userModel->delete($userId);
        $this->guruModel->delete($id);
        session()->setFlashdata('success', 'Sukses Hapus Data');

        return redirect()->to('/admin/guru');
    }
    public function addGuru(){
        $data = $this->request->getPost();
        $nip = $this->request->getPost('nuptk');
        $exiting = $this->guruModel->where('nuptk', $nip)->first();
        if($exiting){
            session()->setFlashdata('warning', 'data NIP sudah terdaftar');
            return redirect()->to('/admin/guru');
        }else{
            $password = $this->request->getPost('nuptk');
            $dataToUser = [
                'username' => $this->request->getPost('nuptk'),
                'name' => $this->request->getPost('nama_guru'),
                'password' => password_hash($password, PASSWORD_DEFAULT),
                'role_id' => 3
            ];
    
    
            $this->userModel->save($dataToUser);
            $this->guruModel->save($data);
            session()->setFlashdata('success', 'Sukses Tambah Guru');
            return redirect()->to('/admin/guru');
        }

       
    }

    public function edit($id){
        // $data['guru'] = $this->guruModel->findAll();
        $data['guru'] = $this->guruModel->find($id);
        echo view('admin/template_admin/header');
        echo view('admin/template_admin/sidebar');
        echo view('admin/edit_guru', $data);
        echo view('admin/template_admin/footer');
    }

    public function update($id){
        
        $data = $this->request->getPost();
        $this->guruModel->update($id, $data);
        session()->setFlashdata('success', 'Update Guru');

        return redirect()->to('/admin/guru');
    }
}
