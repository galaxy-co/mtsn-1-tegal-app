<?php

namespace App\Controllers\Admin;
use App\Models\Admin\NilaiModel;
use App\Models\Admin\KelasModel;
use App\Models\Admin\GuruModel;
use App\Models\Admin\MapelModel;
use App\Models\Admin\SiswaModel;
use App\Models\Admin\NilaiDetailModel;
use App\Models\Admin\RFNilaiDetailModel;
use App\Models\Admin\RfMapelModel;
use CodeIgniter\API\ResponseTrait;

use App\Controllers\BaseController;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


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
        $this->RfMapelModel = new RfMapelModel();
    }

    public function index()
    {
        $data['nilai'] = $this->NilaiModel
            ->join('kelas','kelas.id_kelas = nilai.id_kelas')
            ->join('mapel','mapel.id_mapel = nilai.id_mapel')
            ->join('guru','guru.id_guru = nilai.id_guru')
            ->groupBy('nilai.id_kelas')
            ->groupBy('nilai.id_mapel')
            ->findAll();
        
        $data['kelas'] = $this->KelasModel->findAll();
        $data['guru'] = $this->GuruModel->findAll();
        $data['mapel'] = $this->MapelModel->findAll();
        
        echo view('admin/template_admin/header');
        echo view('admin/template_admin/sidebar');
        echo view('nilai/index', $data);
        echo view('admin/template_admin/footer');
    }

    public function rfmapel($id){
        $response=[
            'status'=> 'OKE',
            'data' => $this->RfMapelModel->where('id_kelas',$id)->findAll()
        ];
        return $this->respond($response,200); 
    }

    private function saveNilai($id_nilai=null,$data){
        // dd($data);
        
        $saveNilai = $this->NilaiModel->save($data);
        return $id_nilai ? $id_nilai : $this->NilaiModel->getInsertID();
    }

    private function saveNilaiDetail($nilai_detail_id=null,$data){
       
        $this->NilaiDetailModel->save($data);
        return $nilai_detail_id ? $nilai_detail_id : $this->NilaiDetailModel->getInsertID();
    }

    public function generateNilai($input,$data){
        $inputAsObject = (object)$input;
        $counter = $data['rf_nilai_detail'][0]['kurikulum_id'] == 1 ? 9 : 6;
        $kdPrefix = $data['rf_nilai_detail'][0]['kurikulum_id'] == 1 ? 'KD' : 'BAB';
        
        foreach($data['siswa'] as $siswa){
            $inputAsObject->id_siswa = $siswa['id_siswa'];
            $nilai_id = $this->saveNilai(null,$inputAsObject);
            for($i=1; $i < $counter ; $i++){
                foreach($data['rf_nilai_detail'] as $rf){     
                    $dataSaveNilaiDetail =  [
                        "rf_nilai_detail_id" =>$rf['rf_nilai_detail_id'],
                        
                        "notes"=>"sample notes",
                        "kd_name" => $kdPrefix." ".$i,
                        "id_nilai" => $nilai_id
                    ];
                    $nilai_detail_id = $this->saveNilaiDetail(null,$dataSaveNilaiDetail); 
                }
            }
        }
    }

    public function detail(){
        
        $inputPost = $this->request->getVar();
        $data['nilai'] = $this->request->getVar();
        // dd($inputPost);
       
        $data['siswa'] =$this->SiswaModel->where('kelas',$inputPost['id_kelas'])->findAll();
        $kurikulum = $this->KelasModel->select('kurikulum')->where('id_kelas',$inputPost['id_kelas'])->find();
        $data['rf_nilai_detail'] = $this->RFNilaiDetailModel->where('kurikulum_id',$kurikulum[0]['kurikulum'])->orderBy('rf_nilai_detail_id')->findAll();
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

   

    public function delete(){
        // var_dump($id);
        // die;
        $req = $this->request->getPost();
        
        // $this->NilaiModel->delete();
        $this->NilaiModel
            ->where('id_kelas',$req['id_kelas'])
            ->where('id_mapel',$req['id_mapel'])
            ->where('id_guru',$req['id_guru'])
            ->delete();

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

    public function export(){
        $fileName = 'nilai-harian.xlsx';  
        $request = $this->request->getPost();

        $data = $this->SiswaModel
            ->select('siswa.nism,siswa.nisn,siswa.nama_siswa,
            nilai.id_mapel,
            mapel.nama_mapel,
            kelas.nama_kelas,kelas.tingkat,
            nilai_detail.nilai,nilai_detail.kd_name,nilai_detail.rf_nilai_detail_id')
            ->join('nilai','nilai.id_siswa = siswa.id_siswa')
            ->join('kelas','kelas.id_kelas = nilai.id_kelas','left')
            ->join('nilai_detail','nilai_detail.id_nilai = nilai.id_nilai AND nilai_detail.rf_nilai_detail_id = 4')
            ->join('mapel','mapel.id_mapel = nilai.id_mapel')
            ->where('kelas',$request['id_kelas'])
            ->where('nilai.id_mapel',$request['id_mapel'])
            ->orderBy('nilai_detail.kd_name')
            ->orderBy('siswa.nama_siswa')
            ->findAll();
        // dd($data);

        $spreadsheet = new Spreadsheet();
        $temp_kd_name = '';
        $rows = 8;
        $worksheet1 ;
        for ($i=0; $i < count($data) ; $i++) { 
            # code...
            if($temp_kd_name !== $data[$i]['kd_name']){
                $worksheet1 = $spreadsheet->createSheet();
                $worksheet1->setTitle($data[$i]['kd_name']);

                $worksheet1->setCellValue('A1','TEMPLATE NILAI HARIAN');
                $worksheet1->setCellValue('A2', 'Nama');
                $worksheet1->setCellValue('B2', $data[$i]['kd_name']);
                $worksheet1->setCellValue('C2', 'Kelas/Mapel');
                $worksheet1->setCellValue('D2', $data[$i]['tingkat'].' '.$data[$i]['nama_kelas'].'/'.$data[$i]['nama_mapel']);
                $worksheet1->setCellValue('A3', 'Materi');
                $worksheet1->mergeCells("A1:E1");
                $worksheet1->mergeCells("D2:E2");
                $worksheet1->mergeCells("B3:E3");

                //  Header
                $worksheet1->setCellValue('A6', 'No');
                $worksheet1->setCellValue('B6', 'NIS');
                $worksheet1->setCellValue('C6', 'NISN');
                $worksheet1->setCellValue('D6', 'NAMA');
                $worksheet1->setCellValue('E6', 'NILAI');

                $worksheet1->setCellValue('A7', 1 );
                $worksheet1->setCellValue('B7',$data[$i]['nism'] );
                $worksheet1->setCellValue('C7',$data[$i]['nisn'] );
                $worksheet1->setCellValue('D7',$data[$i]['nama_siswa'] );
                $worksheet1->setCellValue('E7',$data[$i]['nilai'] );
                $rows = 8;
                // data
            }else{
                $worksheet1->setCellValue('A'.$rows, $rows-6 );
                $worksheet1->setCellValue('B'.$rows,$data[$i]['nism'] );
                $worksheet1->setCellValue('C'.$rows,$data[$i]['nisn'] );
                $worksheet1->setCellValue('D'.$rows,$data[$i]['nama_siswa'] );
                $worksheet1->setCellValue('E'.$rows,$data[$i]['nilai'] );
                $rows++;
            }

            $temp_kd_name= $data[$i]['kd_name'];
        }
        // create worksheet

       
       

        $writer = new Xlsx($spreadsheet);
        $writer->save($fileName);
        return $this->response->download($fileName,null);
    }
}
