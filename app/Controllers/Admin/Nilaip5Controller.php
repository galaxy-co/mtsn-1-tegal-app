<?php

namespace App\Controllers\Admin;
use App\Models\Admin\KelasModel;
use App\Models\Admin\DimensiModel;
use App\Models\Admin\ProyekModel;
use App\Models\Admin\ProjectDimensiModel;
use App\Models\Admin\ElemenModel;
use App\Models\Admin\CapaianModel;
use App\Models\Admin\RFNilaiP5Model;
use App\Models\Admin\PenilaianP5Model;
use App\Models\Admin\SiswaModel;

use App\Controllers\BaseController;

use CodeIgniter\API\ResponseTrait;

class Nilaip5Controller extends BaseController
{
    protected $kelasModel;
    use ResponseTrait;
    public function __construct()
    {
        $this->kelasModel = new KelasModel();
        $this->DimensiModel = new DimensiModel();
        $this->ProyekModel = new ProyekModel();
        $this->ElemenModel = new ElemenModel();
        $this->CapaianModel = new CapaianModel();
        $this->RFNilaiP5Model = new RFNilaiP5Model();
        $this->ProjectDimensiModel = new ProjectDimensiModel();
        $this->PenilaianP5Model = new PenilaianP5Model();
        $this->SiswaModel = new SiswaModel();
    }

    private function getData($key = '',$param = null){
        switch ($key) {
            case 'dimensi':
                
                return [
                    'tingkat' => $this->request->getVar('tingkat'),
                    'kelas' => $this->kelasModel->where('kurikulum',2)->findAll(),
                    'dimensi' => $this->DimensiModel->where('id_kelas',$this->request->getVar('tingkat'))->findAll(),
                ];
                break;
                case 'elemen':
                    return [
                        'elemen' => $this->ElemenModel
                            ->select('dimensi_p5.id_dimensi,dimensi_p5.dimensi,
                            element_p5.id_element,element_p5.kode_element,element_p5.desc,element_p5.id_parent_element,element_p5.nilai_rahmatan_lil_alamin,element_p5.sub_nilai,
                            element_p5_child.desc as element_parent_desc,element_p5_child.kode_element as kode_parent_element
                            '
                            )
                            ->join('element_p5 AS element_p5_child','element_p5_child.id_element = element_p5.id_parent_element','left')
                            ->join('dimensi_p5','dimensi_p5.id_dimensi = element_p5.dimensi AND dimensi_p5.id_kelas='.$this->request->getVar('tingkat'),'left')
                            ->findAll(),
                        'capaian' => $this->CapaianModel
                            ->select('capaian_p5.kode_capaian,capaian_p5.nilai_rahmatan_lil_alamin,capaian_p5.sub_nilai,capaian_p5.id_capaian,capaian_p5.desc,capaian_p5.id_parent_element, 
                            element_p5.desc as element_desc,
                            dimensi_p5.id_dimensi')
                            ->join('element_p5','element_p5.id_element = capaian_p5.id_parent_element','left')
                            ->join('dimensi_p5','dimensi_p5.id_dimensi = element_p5.dimensi AND dimensi_p5.id_kelas='.$this->request->getVar('tingkat'),'left')
                            ->findAll(),
                        'dimensi' => $this->DimensiModel->findAll()
                    ];
                    break;
            case 'proyek':
                    return [
                        'dimensi' => $this->DimensiModel->findAll(),
                        'proyek' => $this->ProyekModel->where('tingkat',$this->request->getVar('tingkat'))->findAll(),
                        'capaian' => $this->CapaianModel
                            ->join('element_p5','element_p5.id_element = capaian_p5.id_parent_element','left')
                            ->join('dimensi_p5','dimensi_p5.id_dimensi = element_p5.dimensi AND dimensi_p5.id_kelas='.$this->request->getVar('tingkat'),'left')
                            ->findAll(),
                        'project_dimensi' =>$this->ProjectDimensiModel
                            ->select('
                                dimensi_p5.dimensi,dimensi_p5.id_dimensi,dimensi_p5.kode_dimensi,
                                capaian_p5.*,
                                project_dimensi.id_project_dimensi,project_dimensi.id_project')
                            ->join('dimensi_p5','dimensi_p5.id_dimensi = project_dimensi.id_dimensi AND dimensi_p5.id_kelas='.$this->request->getVar('tingkat'),'left')
                            ->join('capaian_p5','capaian_p5.id_capaian = project_dimensi.kode_capaian_fase','left')
                            ->findAll()
                    ];
                break;
            case 'nilai':
                return [
                    'nilai' => $this->RFNilaiP5Model->findAll(),
                    'kelas' => []
                ];
                break;
            case 'penilaian':
                return [
                    'proyek' =>$this->ProyekModel->where('tingkat',$this->request->getVar('tingkat'))->findAll()
                ];
                break;
            case 'cek_deskripsi':
                return [
                    'siswa' =>$this->SiswaModel->findAll(),
                    'header_dimensi'=>$this->DimensiModel->findAll(),
                    'nilai' =>  $this->DimensiModel
                            ->select('
                                dimensi_p5.dimensi,dimensi_p5.id_dimensi,dimensi_p5.id_kelas,
                                nilaip5.nilai,
                                siswa.nama_siswa,siswa.id_siswa,
                                project_dimensi.id_project
                            ')
                            ->join('project_dimensi','project_dimensi.id_dimensi = dimensi_p5.id_dimensi','LEFT')
                            ->join('nilaip5','nilaip5.id_project_dimensi = project_dimensi.id_project_dimensi','LEFT')
                            ->join('siswa','siswa.id_siswa = nilaip5.id_siswa','LEFT')
                            ->where('dimensi_p5.id_kelas',$this->request->getVar('tingkat'))
                            ->orderBy('siswa.nama_siswa','ASC')
                            ->orderBy('dimensi_p5.id_dimensi','ASC')
                            ->orderBy('project_dimensi.id_project','ASC')
                            ->findAll(),
                    'header_project' => $this->ProyekModel->where('tingkat',$this->request->getVar('tingkat'))->findAll()
                ];
                break;
            default:
               return [
                'tingkat_kelas' => [7,8,9]
               ];
                break;
        }
    }

    public function index($key = 'index')
    {
        
        if($key == 'capaian') $key ='elemen';
        if($key == 'capaian_proyek') $key ='proyek';
        
        $data = $this->getData($key);
        // dd($data);

        $data['tingkat'] = $this->request->getVar('tingkat');
        if($key =='penilaian'){
            // dd($data);
            if(count($data['proyek']) > 0){
                return redirect()->to('/admin/p5/view/penilaian/'.$data['proyek'][0]['id_project'].'?tingkat='.$data['tingkat']);
            }
        }


        echo view('admin/template_admin/header');
        echo view('admin/template_admin/sidebar');
        echo view('p5/'.$key, $data);
        echo view('admin/template_admin/footer');
    }

    public function penilaian($id){ // VIEW/PREMALINK
        $id_kelas = $this->request->getVar('id_kelas');
        
        
        // $data = $this->getData('penilaian',);
        $data=[
            'penilaian' => $this->PenilaianP5Model
                ->select('nilaip5.*,rf_nilai_p5_options.desc')
                ->join('rf_nilai_p5_options','rf_nilai_p5_options.id_nilaip5_option = nilaip5.nilai','left')
                ->findAll(),
            'proyek' =>$this->ProyekModel->where('tingkat',$this->request->getVar('tingkat'))->findAll(),
            'proyek_detail'=>$this->ProyekModel->find($id),
            'project_dimensi' =>$this->ProjectDimensiModel
                    ->select('
                        dimensi_p5.dimensi,dimensi_p5.id_dimensi,dimensi_p5.kode_dimensi,
                        capaian_p5.*,
                        project_dimensi.id_project_dimensi,project_dimensi.id_project')
                    ->join('dimensi_p5','dimensi_p5.id_dimensi = project_dimensi.id_dimensi','left')
                    ->join('capaian_p5','capaian_p5.id_capaian = project_dimensi.kode_capaian_fase','left')
                    ->where('project_dimensi.id_project',$id)
                    ->findAll(),
            'siswa'=> $this->SiswaModel->where('kelas',$id_kelas)->findAll(),
            'kelas' => $this->kelasModel->where('tingkat', $this->request->getVar('tingkat'))->findAll(),
            'nilai' => $this->RFNilaiP5Model->findAll()
        ];
        $data['tingkat'] = $this->request->getVar('tingkat');
        $data['id_kelas'] = $id_kelas;
        // dd($data);
        echo view('admin/template_admin/header');
        echo view('admin/template_admin/sidebar');
        echo view('p5/penilaian', $data);
        echo view('admin/template_admin/footer');
    }

    private function getModel($key){
        switch ($key) {
            case 'dimensi':
                return new DimensiModel();
                break;
            case 'elemen' :
                return new ElemenModel();
                break;
            case 'capaian' :
                return new CapaianModel();
                break;
            case 'proyek':
                return new ProyekModel();
                break;
            case 'capaian_proyek':
                return new ProjectDimensiModel();
                break;
            case 'nilai':
                return new RFNilaiP5Model();
                break;
            default:
                # code...
                break;
        }
    }

   

    public function store($key=null){
        $data = $this->request->getPost();
        if($key == 'elemen' && $this->request->getPost('id_parent_element') == 'null'){
            $data['id_parent_element'] = null;
        }
        // dd($data,$key);
        $model = $this->getModel($key);

        
        $save=$model->save($data);
        
        session()->setFlashdata('success', 'Sukses Input Kelas');
        return redirect()->to('/admin/p5/view/'.$key.'?tingkat='.$this->request->getVar('tingkat'));
    }

    public function store_nilai(){
        $dataPost = $this->request->getVar();

        $save = $this->PenilaianP5Model->save($dataPost);
        $id= $this->request->getVar('id_nilai') ? $this->request->getVar('id_nilai') : $this->PenilaianP5Model->getInsertID();
        $response = [
            "status" => "OKE",
            "message" => "Data Nilai Successfully stored!!",
            "id_nilai"=> $id
        ];

        return $this->respond($response,200);
    }


    public function delete($key,$id){
        $model = $this->getModel($key);
        $model->delete($id);
        session()->setFlashdata('success', 'Sukses Delete Data');
        return redirect()->to('/admin/p5/view/'.$key.'?tingkat='.$this->request->getVar('tingkat'));
    }

}
