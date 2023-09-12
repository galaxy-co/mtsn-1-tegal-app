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
        $data['nilai'] = $this->NilaiModel
            ->join('kelas','kelas.id_kelas = nilai.id_kelas')
            ->join('mapel','mapel.id_mapel = nilai.id_mapel')
            ->join('guru','guru.id_guru = nilai.id_guru')
            ->groupBy('nilai.id_kelas')
            ->findAll();
        $data['kelas'] = $this->KelasModel->findAll();
        $data['guru'] = $this->GuruModel->findAll();
        $data['mapel'] = $this->MapelModel->findAll();
        
        echo view('admin/template_admin/header');
        echo view('admin/template_admin/sidebar');
        echo view('nilai/index', $data);
        echo view('admin/template_admin/footer');
    }

    private function saveNilai($id_nilai=null,$data){
        
        $saveNilai = $this->NilaiModel->save($data);
        return $id_nilai ? $id_nilai : $this->NilaiModel->getInsertID();
    }

    private function saveNilaiDetail($nilai_detail_id=null,$data){
       
        $this->NilaiDetailModel->save($data);
        return $nilai_detail_id ? $nilai_detail_id : $this->NilaiDetailModel->getInsertID();
    }

    public function generateNilai($input,$data){
        $inputAsObject = (object)$input;
        $dataReturn =[];
        foreach($data['siswa'] as $siswa){
            $inputAsObject->id_siswa = $siswa['id_siswa'];
            $nilai_id = $this->saveNilai(null,$inputAsObject);
            for($i=1; $i < 9 ; $i++){
                foreach($data['rf_nilai_detail'] as $rf){ 
                    $dataSaveNilaiDetail =  [
                        "rf_nilai_detail_id" =>$rf['rf_nilai_detail_id'],
                        "nilai" =>0,
                        "notes"=>"sample notes",
                        "kd_name" => "KD ".$i,
                        "id_nilai" => $nilai_id
                    ];
                    $nilai_detail_id = $this->saveNilaiDetail(null,$dataSaveNilaiDetail);   
                }
            }
        }
    }

    public function detail(){
        
        $inputPost = $this->request->getPost();
        $data['nilai'] = $this->request->getPost();
        // dd($inputPost);
       
        $data['siswa'] =$this->SiswaModel->where('kelas',$inputPost['id_kelas'])->findAll();
        $data['rf_nilai_detail'] = $this->RFNilaiDetailModel->orderBy('rf_nilai_detail_id')->findAll();
        $cekData = $this->NilaiModel->where('id_mapel',$inputPost['id_mapel'])
            ->where('id_kelas',$inputPost['id_kelas'])
            ->where('id_guru',$inputPost['id_guru'])
            ->findAll();
        if(!$cekData){
            $this->generateNilai($inputPost,$data);
        }
        
        $data['mapel'] =$this->MapelModel->where('tingkal_kelas',$inputPost['id_kelas'])->findAll();
        $data['kelas'] = $this->KelasModel->findAll();
        $data['guru'] = $this->GuruModel->findAll();
        $data['mapel'] = $this->MapelModel->findAll();

        $data['nilai_get'] = $this->NilaiModel
            ->join('siswa','siswa.id_siswa = nilai.id_siswa','left')
            ->where('id_kelas',$inputPost['id_kelas'])
            ->where('id_mapel',$inputPost['id_mapel'])
            ->findAll();

       
        $ids_nilai = [];
        foreach($data['nilai_get'] as $nil){
            array_push($ids_nilai,$nil['id_nilai']);
        }

        $data['header']= [];
        if(count($ids_nilai) > 0){
            $data['nilai_detail']=$this->NilaiDetailModel->whereIn('id_nilai',$ids_nilai)->findAll();
            
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

        } 

        echo view('admin/template_admin/header');
        echo view('admin/template_admin/sidebar');
        echo view('nilai/detail', $data);
        echo view('admin/template_admin/footer');
    }

    

    public function store_kd_name(){
        $data = $this->request->getJSON();
        
       
        $nilai_detail = $this->NilaiDetailModel->set('kd_name',$data->kd_name)->whereIn("nilai_detail_id",explode(",",$data->nilai_detail_ids))->update();

        $response = [
            "status" => "OKE",
            "message" => "Data KD Name Successfully stored!!",
            "data" =>$nilai_detail
        ];
        return $this->respond($response,200);
    }

    public function store_nilai(){

        $data = $this->request->getJSON();
       
        $this->NilaiDetailModel->save($data);

        $response = [
            "status" => "OKE",
            "message" => "Data Nilai Successfully stored!!",
        ];
        return $this->respond($response, 200);
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
