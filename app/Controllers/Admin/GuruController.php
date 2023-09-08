<?php

namespace App\Controllers\Admin;
use App\Models\Admin\GuruModel;
use App\Controllers\BaseController;


class GuruController extends BaseController
{
    protected $guruModel;
    public function __construct()
    {
        $this->guruModel = new GuruModel();
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
                    $data = [
                        'nama_guru' => $value[1],
                        'nuptk' => $value[2]
                    ];
                }
                $this->guruModel->save($data);
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
        $this->guruModel->delete($id);

        session()->setFlashdata('success', 'Sukses Hapus Data');

        return redirect()->to('/admin/guru');
    }
    public function addGuru(){
        $data = $this->request->getPost();
        $this->guruModel->save($data);

        session()->setFlashdata('success', 'Sukses Tambah Guru');
        return redirect()->to('/admin/guru');
    }
}
