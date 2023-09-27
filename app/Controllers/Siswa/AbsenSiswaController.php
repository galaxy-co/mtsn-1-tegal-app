<?php

namespace App\Controllers\Siswa;

use App\Controllers\BaseController;
use App\Models\Admin\AbsenModel;
use App\Models\Admin\SiswaModel;
use App\Models\Admin\KelasModel;

class AbsenSiswaController extends BaseController
{
    protected $absenModel;
    protected $siswaModel;
    public function __construct()
    {
        $this->absenModel = new AbsenModel();
        $this->siswaModel = new SiswaModel();
    }
    public function index()
    {
        $session = session();
        $name = $session->get('name');
        $data['name'] = $name;
        $nism = $session->get('username');
        $siswa = $this->siswaModel->where('nism', $nism)->first();
        $siswaId = $siswa['id_siswa'];
        $kelasId = $siswa['kelas'];

        $data['absen'] = $this->absenModel->where('id_siswa', $siswaId)->findAll();

        $groupedData = [];

                        foreach ($data['absen'] as $s) {
                            $semesterTahun = $s['semester'] . '-' . $s['tahun_ajaran'];
                            if (!isset($groupedData[$semesterTahun])) {
                                $groupedData[$semesterTahun] = [];
                            }
                            $groupedData[$semesterTahun][] = $s;
                        }
                    $data['groupedData'] = $groupedData;
        echo view('admin/template_admin/header');
        echo view('admin/template_admin/sidebar_siswa', $data);
        echo view('siswa/absenSiswa', $data);
        echo view('admin/template_admin/footer');
    }
}
