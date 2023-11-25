<?php

namespace App\Controllers\Admin;
use App\Models\Admin\NilaiKetrampilanModel;
use App\Models\Admin\KelasModel;
use App\Models\Admin\GuruModel;
use App\Models\Admin\MapelModel;
use App\Models\Admin\SiswaModel;
use App\Models\Admin\NilaiKetrampilanDetailModel;
use App\Models\Admin\RFNilaiKetrampilanDetailModel;
use App\Models\Admin\RfMapelModel;
use App\Models\Admin\SettingsModel;
use CodeIgniter\API\ResponseTrait;

use App\Controllers\BaseController;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class NilaiKetrampilanController extends BaseController
{
    protected $NilaiModel;
    protected $KelasModel;
    protected $GuruModel;
    protected $MapelModel;
    protected $SiswaModel;
    protected $RFNilaiDetailModel;
    protected $NilaiDetailModel;
    protected $RfMapelModel;
    protected $SettingModel;
    use ResponseTrait;
    public function __construct()
    {
        $this->NilaiModel = new NilaiKetrampilanModel();
        $this->KelasModel = new KelasModel();
        $this->GuruModel = new GuruModel();
        $this->MapelModel = new MapelModel();
        $this->SiswaModel = new SiswaModel();
        $this->RFNilaiDetailModel = new RFNilaiKetrampilanDetailModel();
        $this->NilaiDetailModel = new NilaiKetrampilanDetailModel();
        $this->RfMapelModel = new RfMapelModel();
        $this->SettingModel = new SettingsModel();
    }

    public function index()
    {
        $role=session('role_id'); // 3 guru
        $username = session('username');

        $settings = $this->SettingModel->first();
        $semester = $settings['semester'];
        $ta = $settings['tahun_ajaran'];
        
        $queryNilai = $this->NilaiModel
            ->join('kelas','kelas.id_kelas = nilaiKetrampilan.id_kelas')
            ->join('mapel','mapel.id_mapel = nilaiKetrampilan.id_mapel')
            ->join('guru','guru.id_guru = nilaiKetrampilan.id_guru')
            ->where('nilaiKetrampilan.semester', $semester)
            ->where('nilaiKetrampilan.tahun_ajaran', $ta);
        $queryMapel = $this->MapelModel;
        $queryGuru = $this->GuruModel;
        $queryKelas = $this->KelasModel;
      
        if($role == 3){
            // $guruData =;
            $queryNilai->where('nilaiKetrampilan.id_guru',$this->GuruModel->where('nuptk',$username)->first()['id_guru']);
            
            $queryKelas->join('rfmapel','rfmapel.id_kelas = kelas.id_kelas','LEFT')->where('rfmapel.id_guru',$this->GuruModel->where('nuptk',$username)->first()['id_guru'])->groupBy('kelas.id_kelas');
            $queryMapel->join('rfmapel','rfmapel.id_mapel = mapel.id_mapel','RIGHT')->where('rfmapel.id_guru',$this->GuruModel->where('nuptk',$username)->first()['id_guru']);
            $queryGuru->where('guru.nuptk',$username);
            
        }
        $data['nilaiketrampilan'] = $queryNilai
            ->groupBy('nilaiKetrampilan.id_kelas')
            ->groupBy('nilaiKetrampilan.id_mapel')
            ->findAll();
        
        $data['kelas'] = $queryKelas->where('kurikulum = 1')->findAll();
        $data['guru'] = $queryGuru->findAll();
        $data['mapel'] = $queryMapel->findAll();
        // dd($data);
        echo view('admin/template_admin/header');
        echo view('admin/template_admin/sidebar');
        echo view('nilaiKetrampilan/index', $data);
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
        $settings = $this->SettingModel->first();
        $semester = $settings['semester'];
        $ta = $settings['tahun_ajaran'];
        foreach($data['siswa'] as $siswa){
            $inputAsObject->id_siswa = $siswa['id_siswa'];
            $inputAsObject->semester = $semester;
            $inputAsObject->tahun_ajaran = $ta;
                        
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
    public function regenerate(){
        $role=session('role_id');
        $settings = $this->SettingModel->first();
        $semester = $settings['semester'];
        $ta = $settings['tahun_ajaran'];
        $inputPost = $this->request->getVar();
        $data['functionName'] = 'regenarate';
        $data['allSiswa'] =$this->SiswaModel->where('kelas',$inputPost['id_kelas'])->findAll();
        $kurikulum = $this->KelasModel->select('kurikulum')->where('id_kelas',$inputPost['id_kelas'])->find();
        $data['rf_nilai_detail'] = $this->RFNilaiDetailModel->where('kurikulum_id',$kurikulum[0]['kurikulum'])->orderBy('rf_nilai_detail_id')->findAll();
        $cekNilai = $this->NilaiModel->where('id_kelas', $inputPost['id_kelas'])
                                    ->where('id_guru', $inputPost['id_guru'])
                                    ->where('id_mapel', $inputPost['id_mapel'])
                                    ->where('semester', $semester)
                                    ->where('tahun_ajaran', $ta)
                                    ->findAll();
        $existingStudentIds = array_column($cekNilai, 'id_siswa');
        $currentSIswa = $this->SiswaModel->where('kelas', $inputPost['id_kelas'])->findAll();
        $nilaiSiswaIds = array_column($cekNilai, 'id_siswa');
        $currentSiswaIds = array_column($currentSIswa, 'id_siswa');
        $idSiswaTidakAda = array_diff($nilaiSiswaIds, $currentSiswaIds);

        $missingStudents = array_filter($data['allSiswa'], function($siswa) use ($existingStudentIds) {
            return !in_array($siswa['id_siswa'], $existingStudentIds);
        });
        $data['siswa'] = $missingStudents;
        if($missingStudents){
            $this->generateNilai($inputPost,$data);
            $queryParams = [
                'id_kelas' => $inputPost['id_kelas'],
                'id_mapel' => $inputPost['id_mapel'],
                'id_guru'  => $inputPost['id_guru'],
            ];
            if($role == 3){
                $redirectUrl = '/guru/nilaiKetrampilan/detail?' . http_build_query($queryParams);
            }else{
                $redirectUrl = '/admin/nilaiKetrampilan/detail?' . http_build_query($queryParams);
            }
           
    
            session()->setFlashdata('success', 'Berhasil Generate Data');
    
            return redirect()->to($redirectUrl);
        }elseif($idSiswaTidakAda){
            $queryParams = [
                'id_kelas' => $inputPost['id_kelas'],
                'id_mapel' => $inputPost['id_mapel'],
                'id_guru'  => $inputPost['id_guru'],
            ];
            
            foreach ($idSiswaTidakAda as $idSiswaTidakAdaPerid) {
                $nilaiTodelete = $this->NilaiModel->where('id_siswa', $idSiswaTidakAdaPerid)->find();
                // $idNilai = $nilaiTodelete["id_nilai"];
                
                foreach($nilaiTodelete as $nilai){
                    $this->NilaiModel->delete($nilai['id_nilai']);
                }
            }
            if($role == 3){
                $redirectUrl = '/guru/nilaiKetrampilan/detail?' . http_build_query($queryParams);
            }else{
                $redirectUrl = '/admin/nilaiKetrampilan/detail?' . http_build_query($queryParams);
            }
            
    
            session()->setFlashdata('success', 'Berhasil Generate Data');
            return redirect()->to($redirectUrl);
            
        }else{
            $queryParams = [
                'id_kelas' => $inputPost['id_kelas'],
                'id_mapel' => $inputPost['id_mapel'],
                'id_guru'  => $inputPost['id_guru'],
            ];
            if($role == 3){
                $redirectUrl = '/guru/nilaiKetrampilan/detail?' . http_build_query($queryParams);
            }else{
                $redirectUrl = '/admin/nilaiKetrampilan/detail?' . http_build_query($queryParams);
            }
            
    
            session()->setFlashdata('warning', 'Tidak Ada Data Yang Perlu Di Generate Ulang');
    
            return redirect()->to($redirectUrl);
        }
        if($idSiswaTidakAda){
            $queryParams = [
                'id_kelas' => $inputPost['id_kelas'],
                'id_mapel' => $inputPost['id_mapel'],
                'id_guru'  => $inputPost['id_guru'],
            ];
            
            foreach ($idSiswaTidakAda as $idSiswaTidakAdaPerid) {
                $nilaiTodelete = $this->NilaiModel->where('id_siswa', $idSiswaTidakAdaPerid)->find();
                // $idNilai = $nilaiTodelete["id_nilai"];
                
                foreach($nilaiTodelete as $nilai){
                    $this->NilaiModel->delete($nilai['id_nilai']);
                }
            }
            if($role == 3){
                $redirectUrl = '/guru/nilaiKetrampilan/detail?' . http_build_query($queryParams);
            }else{
                $redirectUrl = '/admin/nilaiKetrampilan/detail?' . http_build_query($queryParams);
            }
            
    
            session()->setFlashdata('success', 'Berhasil Generate Data');
            return redirect()->to($redirectUrl);
        }else{
            $queryParams = [
                'id_kelas' => $inputPost['id_kelas'],
                'id_mapel' => $inputPost['id_mapel'],
                'id_guru'  => $inputPost['id_guru'],
            ];

            if($role == 3){
                $redirectUrl = '/guru/nilaiKetrampilan/detail?' . http_build_query($queryParams);
            }else{
                $redirectUrl = '/admin/nilaiKetrampilan/detail?' . http_build_query($queryParams);
            }
            
    
            session()->setFlashdata('warning', 'Tidak Ada Data Yang Perlu Di Generate Ulang');
    
            return redirect()->to($redirectUrl);
        }
    }
    public function detail(){
        
        $inputPost = $this->request->getVar();
        $data['nilaiketrampilan'] = $this->request->getVar();
        $settings = $this->SettingModel->first();
        $semester = $settings['semester'];
        $ta = $settings['tahun_ajaran'];
       
        $data['siswa'] =$this->SiswaModel->where('kelas',$inputPost['id_kelas'])->findAll();
        $kurikulum = $this->KelasModel->select('kurikulum')->where('id_kelas',$inputPost['id_kelas'])->find();
        $data['rf_nilai_detail'] = $this->RFNilaiDetailModel->where('kurikulum_id',$kurikulum[0]['kurikulum'])->orderBy('rf_nilai_detail_id')->findAll();
        
        $cekData = $this->NilaiModel->where('id_mapel',$inputPost['id_mapel'])
            ->where('id_kelas',$inputPost['id_kelas'])
            ->where('id_guru',$inputPost['id_guru'])
            ->where('nilaiKetrampilan.semester', $semester)
            ->where('nilaiKetrampilan.tahun_ajaran', $ta)
            ->findAll();
            
        if(!$cekData){
            $this->generateNilai($inputPost,$data);
        }
        
       
        $data['mapel'] =$this->MapelModel->where('tingkal_kelas',$inputPost['id_kelas'])->findAll();
        $data['kelas'] = $this->KelasModel->findAll();
        $data['guru'] = $this->GuruModel->findAll();
        $data['mapel'] = $this->MapelModel->findAll();

        $data['nilai_get'] = $this->NilaiModel
            ->join('siswa','siswa.id_siswa = nilaiKetrampilan.id_siswa','left')
            ->where('id_kelas',$inputPost['id_kelas'])
            ->where('id_mapel',$inputPost['id_mapel'])
            ->where('nilaiKetrampilan.semester', $semester)
            ->where('nilaiKetrampilan.tahun_ajaran', $ta)
            ->orderBy('siswa.nama_siswa')
            ->findAll();
            // dd($data['nilai_get']);
       
        $ids_nilai = [];
        foreach($data['nilai_get'] as $nil){
            array_push($ids_nilai,$nil['id_nilai']);
        }

        $data['header']= [];
        if(count($ids_nilai) > 0){
            $data['nilaiketrampilandetail']=$this->NilaiDetailModel->whereIn('id_nilai',$ids_nilai)->findAll();
            
            foreach($data['nilaiketrampilandetail'] as $nilai_detail){
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
        echo view('nilaiKetrampilan/detail', $data);
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
            return redirect()->to('/guru/nilaiKetrampilan');
        }
        return redirect()->to('/admin/nilaiKetrampilan');
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
            nilaiKetrampilan.id_mapel,
            mapel.nama_mapel,
            kelas.nama_kelas,kelas.tingkat,
            nilaiKetrampilanDetail.nilai,nilaiKetrampilanDetail.kd_name,nilaiKetrampilanDetail.rf_nilai_detail_id')
            ->join('nilaiKetrampilan','nilaiKetrampilan.id_siswa = siswa.id_siswa')
            ->join('kelas','kelas.id_kelas = nilaiKetrampilan.id_kelas','left')
            ->join('nilaiKetrampilanDetail','nilaiKetrampilanDetail.id_nilai = nilaiKetrampilan.id_nilai AND nilaiKetrampilanDetail.rf_nilai_detail_id = '.$idRfByKurikulum)
            ->join('mapel','mapel.id_mapel = nilaiKetrampilan.id_mapel')
            ->where('kelas',$request['id_kelas'])
            ->where('nilaiKetrampilan.id_mapel',$request['id_mapel'])
            ->orderBy('nilaiKetrampilanDetail.kd_name')
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
