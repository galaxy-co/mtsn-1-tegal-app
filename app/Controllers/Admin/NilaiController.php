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
        $role=session('role_id'); // 3 guru
        $username = session('username');

        
        $queryNilai = $this->NilaiModel
            ->join('kelas','kelas.id_kelas = nilai.id_kelas')
            ->join('mapel','mapel.id_mapel = nilai.id_mapel')
            ->join('guru','guru.id_guru = nilai.id_guru');
        $queryMapel = $this->MapelModel;
        $queryGuru = $this->GuruModel;
        $queryKelas = $this->KelasModel;
      
        if($role == 3){
            // $guruData =;
            $queryNilai->where('nilai.id_guru',$this->GuruModel->where('nuptk',$username)->first()['id_guru']);
            
            $queryKelas->join('rfmapel','rfmapel.id_kelas = kelas.id_kelas','LEFT')->where('rfmapel.id_guru',$this->GuruModel->where('nuptk',$username)->first()['id_guru'])->groupBy('kelas.id_kelas');
            $queryMapel->join('rfmapel','rfmapel.id_mapel = mapel.id_mapel','RIGHT')->where('rfmapel.id_guru',$this->GuruModel->where('nuptk',$username)->first()['id_guru']);
            $queryGuru->where('guru.nuptk',$username);
            
        }
        $data['nilai'] = $queryNilai
            ->groupBy('nilai.id_kelas')
            ->groupBy('nilai.id_mapel')
            ->findAll();
        
        $data['kelas'] = $queryKelas->findAll();
        $data['guru'] = $queryGuru->findAll();
        $data['mapel'] = $queryMapel->findAll();

        // dd($data);
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
            ->orderBy('siswa.nama_siswa')
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
        $data=$this->NilaiModel
        ->where('id_kelas',$req['id_kelas'])
        ->where('id_mapel',$req['id_mapel'])
        ->where('id_guru',$req['id_guru'])
        ->delete();
        // dd($data);
        
        session()->setFlashdata('success', 'Sukses Hapus Data');
        if(session('role_id')==3){
            return redirect()->to('/guru/nilai');
        }
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
    
        $idRfByKurikulum = 4;
        $kelas = $this->KelasModel->find($request['id_kelas']);
        if($kelas['kurikulum'] == 2){
            $idRfByKurikulum = 10;
        }
        // dd($kelas);
        $data = $this->SiswaModel
            ->select('siswa.nism,siswa.nisn,siswa.nama_siswa,
            nilai.id_mapel,
            mapel.nama_mapel,
            kelas.nama_kelas,kelas.tingkat,
            nilai_detail.nilai,nilai_detail.kd_name,nilai_detail.rf_nilai_detail_id')
            ->join('nilai','nilai.id_siswa = siswa.id_siswa')
            ->join('kelas','kelas.id_kelas = nilai.id_kelas','left')
            ->join('nilai_detail','nilai_detail.id_nilai = nilai.id_nilai AND nilai_detail.rf_nilai_detail_id = '.$idRfByKurikulum)
            ->join('mapel','mapel.id_mapel = nilai.id_mapel')
            ->where('kelas',$request['id_kelas'])
            ->where('nilai.id_mapel',$request['id_mapel'])
            ->orderBy('nilai_detail.kd_name')
            ->orderBy('siswa.nama_siswa')
            ->findAll();
        // dd($data);
        $styleArrayLabel = [
            'font' => [
                'bold' => false,
                'color' => ['argb'=>'FFFFFF'],
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
            ],
            'borders' => [
                'top' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
                'bottom' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
                'left' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
                'right' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_GRADIENT_LINEAR,
                'rotation' => 90,
                'startColor' => [
                    'argb' => '7F7F7F',
                ],
                'endColor' => [
                    'argb' => '7F7F7F',
                ],
            ],
        ];
        $styleArrayValueGrey = [
            'font' => [
                'bold' => false,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
            ],
            'borders' => [
                'top' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
                'bottom' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
                'left' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
                'right' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_GRADIENT_LINEAR,
                'rotation' => 90,
                'startColor' => [
                    'argb' => 'BFBFBF',
                ],
                'endColor' => [
                    'argb' => 'BFBFBF',
                ],
            ],
        ];

        $styleArrayValue = [
            'font' => [
                'bold' => false,
                
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
            ],
            'borders' => [
                'top' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
                'bottom' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
                'left' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
                'right' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_GRADIENT_LINEAR,
                'rotation' => 90,
                'startColor' => [
                    'argb' => 'FFFF00',
                ],
                'endColor' => [
                    'argb' => 'FFFF00',
                ],
            ],
        ];
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
                $worksheet1->setCellValue('A2', 'Nama')->getStyle('A2')->applyFromArray($styleArrayLabel);
                $worksheet1->setCellValue('B2', $data[$i]['kd_name'])->getStyle('B2')->applyFromArray($styleArrayValue);
                $worksheet1->setCellValue('C2', 'Kelas/Mapel')->getStyle('C2')->applyFromArray($styleArrayLabel);
                $worksheet1->setCellValue('D2', $data[$i]['tingkat'].' '.$data[$i]['nama_kelas'].'/'.$data[$i]['nama_mapel']);
                $worksheet1->setCellValue('A3', 'Materi')->getStyle('A3')->applyFromArray($styleArrayLabel);
                $worksheet1->mergeCells("A1:E1");
                $worksheet1->mergeCells("D2:E2");
                $worksheet1->mergeCells("B3:E3");
                $worksheet1->getStyle('D2:E2')->applyFromArray($styleArrayValue);
                $worksheet1->getStyle('B3:E3')->applyFromArray($styleArrayValue);

                //  Header
                $worksheet1->setCellValue('A6', 'No')->getStyle('A6')->applyFromArray($styleArrayLabel);
                $worksheet1->setCellValue('B6', 'NIS')->getStyle('B6')->applyFromArray($styleArrayLabel);
                $worksheet1->setCellValue('C6', 'NISN')->getStyle('C6')->applyFromArray($styleArrayLabel);
                $worksheet1->setCellValue('D6', 'NAMA')->getStyle('D6')->applyFromArray($styleArrayLabel);
                $worksheet1->setCellValue('E6', 'NILAI')->getStyle('E6')->applyFromArray($styleArrayLabel);

                $worksheet1->setCellValue('A7', 1 )->getStyle('A7')->applyFromArray($styleArrayValueGrey);;
                $worksheet1->setCellValue('B7',$data[$i]['nism'])->getStyle('B7')->applyFromArray($styleArrayValueGrey);
                $worksheet1->setCellValue('C7',$data[$i]['nisn'])->getStyle('C7')->applyFromArray($styleArrayValueGrey);
                $worksheet1->setCellValue('D7',$data[$i]['nama_siswa'])->getStyle('D7')->applyFromArray($styleArrayValueGrey);
                $worksheet1->setCellValue('E7',$data[$i]['nilai'])->getStyle('E7')->applyFromArray($styleArrayValue);
                $rows = 8;
                // data
            }else{
                $worksheet1->setCellValue('A'.$rows, $rows-6 )->getStyle('A'.$rows)->applyFromArray($styleArrayValueGrey);
                $worksheet1->setCellValue('B'.$rows,$data[$i]['nism'])->getStyle('B'.$rows)->applyFromArray($styleArrayValueGrey);
                $worksheet1->setCellValue('C'.$rows,$data[$i]['nisn'])->getStyle('C'.$rows)->applyFromArray($styleArrayValueGrey);
                $worksheet1->setCellValue('D'.$rows,$data[$i]['nama_siswa'])->getStyle('D'.$rows)->applyFromArray($styleArrayValueGrey);
                $worksheet1->setCellValue('E'.$rows,$data[$i]['nilai'])->getStyle('E'.$rows)->applyFromArray($styleArrayValue);
                $rows++;
            }

            // YELLOW ==>setFill('#FFFF00')
            // GREY ==>setFill('#BFBFBF')
            $worksheet1->getColumnDimension('A')->setAutoSize(true);
            $worksheet1->getColumnDimension('B')->setAutoSize(true);
            $worksheet1->getColumnDimension('C')->setAutoSize(true);
            $worksheet1->getColumnDimension('D')->setAutoSize(true);
            $worksheet1->getColumnDimension('E')->setAutoSize(true);

            $temp_kd_name= $data[$i]['kd_name'];
        }
        //  remove unused worksheet
        $sheetIndex = $spreadsheet->getIndex(
            $spreadsheet->getSheetByName('Worksheet')
        );
        $spreadsheet->removeSheetByIndex($sheetIndex);
        
       
       

        $writer = new Xlsx($spreadsheet);
        $writer->save($fileName);
        return $this->response->download($fileName,null);
    }
}
