<?php

namespace App\Controllers\Admin;
use App\Models\Admin\KelasModel;
use App\Models\Admin\SiswaModel;
use App\Models\Admin\CapaianModel;
use App\Controllers\BaseController;
use App\Models\Admin\PenilaianP5Model;
use App\Models\Admin\ProyekModel;
use App\Models\Admin\ProjectDimensiModel;
use App\Models\Admin\RFNilaiP5Model;
use App\Models\Admin\GuruModel;

use \Dompdf\Dompdf;
use PharIo\Manifest\Application;

class RaportP5Controller extends BaseController
{
    protected $kelasModel;
    protected $siswaModel;
    protected $capaianModel;
    protected $nilaiP5Model;
    protected $rfnilaip5model;
    protected $guruModel;
    public function __construct()
    {
        $this->nilaiP5Model = new PenilaianP5Model();
        $this->kelasModel = new KelasModel();
        $this->siswaModel = new SiswaModel();
        $this->capaianModel = new CapaianModel();
        $this->rfnilaip5model = new RFNilaiP5Model();
        $this->guruModel = new GuruModel();
        
    }
    public function index()
    {
        $data['kelas'] = $this->kelasModel->where('kurikulum', 2)->findAll();
        echo view('admin/template_admin/header');
        echo view('admin/template_admin/sidebar');
        echo view('admin/raportp5', $data);
        echo view('admin/template_admin/footer');
    }
    public function dataSiswa($id_kelas)
    {
        $data['siswa'] = $this->siswaModel->where('kelas', $id_kelas)->findAll();
        echo view('admin/template_admin/header');
        echo view('admin/template_admin/sidebar');
        echo view('admin/siswaPrintRaport', $data);
        echo view('admin/template_admin/footer');
    }
    public function cetakRaport($idSiswa)
    {
        $dompdf = new Dompdf();

        $data['siswa'] = $this->siswaModel
            ->join('kelas','kelas.id_kelas=siswa.kelas')
            ->where('siswa.id_siswa', $idSiswa)
            ->first();
        $idkelas = $data['siswa']['id_kelas'];
        $kelas = $this->kelasModel->where('id_kelas', $idkelas)->first();
        $idGuru = $kelas['id_guru'];
        $data['guru'] = $this->guruModel->where('id_guru', $idGuru)->first();
        
        $data['nilai'] = $this->nilaiP5Model->where('id_siswa', $idSiswa)->findAll();
        $data['rfnilai'] = $this->rfnilaip5model->findAll();

        $data['nilaip5'] = $this->nilaiP5Model
                        ->join('project_dimensi', 'project_dimensi.id_project_dimensi=nilaip5.id_project_dimensi')
                        ->join('projects', 'projects.id_project=project_dimensi.id_project')
                        ->join('rf_nilai_p5_options', 'rf_nilai_p5_options.id_nilaip5_option = nilaip5.nilai')
                        ->join('capaian_p5', 'capaian_p5.id_capaian=project_dimensi.kode_capaian_fase')
                        ->join('dimensi_p5', 'dimensi_p5.kode_dimensi=capaian_p5.kode_capaian')
                        ->join('element_p5', 'element_p5.kode_element=dimensi_p5.kode_dimensi')
                        ->where('nilaip5.id_siswa', $idSiswa)
                        ->findAll();  
                        
                        
        $html = view('admin/templateCetakRaport', $data);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        
        // Menyimpan output PDF ke variabel
        $this->response->setContentType('application/pdf');
        $output = $dompdf->output();
        
        // Mengatur header HTTP untuk menampilkan PDF di browser
        header('Content-Type: application/pdf');
        header('Content-Disposition: inline; filename="raport.pdf"'); // Menampilkan inline di browser
        header('Content-Transfer-Encoding: binary');
        header('Content-Length: ' . strlen($output));
        
        // Menampilkan output PDF
        echo $output;
    }

}
