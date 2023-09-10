<?php

namespace App\Controllers\Admin;
use App\Models\Admin\NilaiModel;
use App\Models\Admin\KelasModel;
use App\Models\Admin\GuruModel;
use App\Models\Admin\MapelModel;
use App\Models\Admin\SiswaModel;
use App\Models\Admin\NilaiDetailModel;
use App\Models\Admin\RFNilaiDetailModel;
use CodeIgniter\API\ResponseTrait;

use App\Controllers\BaseController;


class NilaiController extends BaseController
{
    protected $NilaiModel;
    use ResponseTrait;
    public function __construct()
    {
        $this->NilaiModel = new NilaiModel();
        $this->KelasModel = new KelasModel();
        $this->GuruModel = new GuruModel();
        $this->MapelModel = new MapelModel();
        $this->SiswaModel = new SiswaModel();
        $this->RFNilaiDetailModel = new RFNilaiDetailModel();
        $this->NilaiDetailModel = new NilaiDetailModel();
    }

    public function index()
    {
        $data['nilai'] = $this->NilaiModel->findAll();
        $data['kelas'] = $this->KelasModel->findAll();
        $data['guru'] = $this->GuruModel->findAll();
        $data['mapel'] = $this->MapelModel->findAll();
        
        echo view('admin/template_admin/header');
        echo view('admin/template_admin/sidebar');
        echo view('nilai/index', $data);
        echo view('admin/template_admin/footer');
    }

    public function add(){
        
        $data['nilai'] = $this->request->getPost();
        $data['rf_nilai_detail'] = $this->RFNilaiDetailModel->orderBy('rf_nilai_detail_id')->findAll();
        $data['siswa'] =$this->SiswaModel->where('kelas',$data['nilai']['id_kelas'])->findAll();
        $data['mapel'] =$this->MapelModel->where('tingkal_kelas',$data['nilai']['id_kelas'])->findAll();
        $data['kelas'] = $this->KelasModel->findAll();
        $data['guru'] = $this->GuruModel->findAll();
        $data['mapel'] = $this->MapelModel->findAll();

        echo view('admin/template_admin/header');
        echo view('admin/template_admin/sidebar');
        echo view('nilai/detail', $data);
        echo view('admin/template_admin/footer');

        // if($existingData){
        //     session()->setFlashdata('warning', 'Data Kelas Sudah ada!');
        //     return redirect()->to('/admin/kelas');
        // }
        // $saveNilai = $this->NilaiModel->save($data);

        // $id = $this->NilaiModel->getInsertID();

        // session()->setFlashdata('success', 'Sukses Input Kelas');
        // return redirect()->to('/admin/nilai/detail/'.$id);
    }

    private function saveNilai($data){
        $dataNilai = [
            "id_siswa" => $data->id_siswa,
            "id_mapel" => $data->id_mapel,
            "id_guru" => $data->id_guru,
            "id_kelas" => $data->id_kelas,
        ];
        $saveNilai = $this->NilaiModel->save($dataNilai);
        return $this->NilaiModel->getInsertID();
    }

    public function store(){
        $data = $this->request->getJSON();
        $id_nilai=$this->request->getVar('id_nilai'); 
        $nilai_detail_id =$this->request->getVar('nilai_detail_id');
        if(!$nilai_detail_id){
            $id_nilai = $this->saveNilai($data);
        }
        
        $dataNilaiDetail = [
            "nilai_detail_id" => $nilai_detail_id,
            "id_nilai" => $id_nilai,
            "kd_name" =>$data->kd_name,
            "rf_nilai_detail_id" => $data->rf_nilai_detail_id,
            "nilai" =>$data->nilai,
            "notes" =>$this->request->getVar('notes')
        ];

        $saveNilaiDetail = $this->NilaiDetailModel->save($dataNilaiDetail);
        if(!$saveNilaiDetail){
            return respond([
                "status"=>"FAIL",
                "message" => "Failed to Save Nilai!"
            ]);
        }
        $nilai_detail_id = $nilai_detail_id ? $nilai_detail_id : $this->NilaiDetailModel->getInsertID();

        $response = [
            "status" => "OKE",
            "message" => "Data Nilai Successfully stored!!",
            "id_nilai" =>$id_nilai,
            "nilai_detail_id" => $nilai_detail_id
        ];
        return $this->respond($response, 200);
    }

    public function detail($id){
        $data['nilai'] =$this->NilaiModel->find($id);
        $data['nilai_detail_kd_name']=['KD 1','KD 2','KD3','KD 4','KD 5','KD 6','KD 7','KD 8'];
        $data['rf_nilai_detail'] = $this->RFNilaiDetailModel->orderBy('rf_nilai_detail_id')->findAll();
        $data['siswa'] =$this->SiswaModel->where('kelas',$data['nilai']['id_kelas'])->findAll();
        $data['mapel'] =$this->MapelModel->where('tingkal_kelas',$data['nilai']['id_kelas'])->findAll();
        // dd($data);
        echo view('admin/template_admin/header');
        echo view('admin/template_admin/sidebar');
        echo view('nilai/detail', $data);
        echo view('admin/template_admin/footer');
    }

    public function delete($id_kelas){
        // var_dump($id);
        // die;
        $id_kelas = intval($id_kelas);
        $this->NilaiModel->delete($id_kelas);

        session()->setFlashdata('success', 'Sukses Hapus Data');

        return redirect()->to('/admin/nilai');
    }

    public function edit($id){
        $data['kelas'] = $this->NilaiModel->find($id);
        echo view('admin/template_admin/header');
        echo view('admin/template_admin/sidebar');
        echo view('admin/edit_kelas_in_admin', $data);
        echo view('admin/template_admin/footer');
    }
}
