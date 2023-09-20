<?php

namespace App\Controllers\Admin;
use App\Models\Admin\KelasModel;
use App\Models\Admin\SiswaModel;
use App\Models\Admin\CapaianModel;
use App\Controllers\BaseController;
use App\Models\Admin\PenilaianP5Model;
use \Dompdf\Dompdf;
use PharIo\Manifest\Application;

class RaportP5Controller extends BaseController
{
    protected $kelasModel;
    protected $siswaModel;
    protected $capaianModel;
    protected $nilaiP5Model;
    public function __construct()
    {
        $this->nilaiP5Model = new PenilaianP5Model();
        $this->kelasModel = new KelasModel();
        $this->siswaModel = new SiswaModel();
        $this->capaianModel = new CapaianModel();
        
        
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
        
        $data['nilai'] = $this->nilaiP5Model->where('id_siswa', $idSiswa)->findAll();

        
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
