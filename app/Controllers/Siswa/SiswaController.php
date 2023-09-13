<?php

namespace App\Controllers\Siswa;
use App\Models\Siswa\SiswaModel;
use App\Controllers\BaseController;

class SiswaController extends BaseController
{
    protected $siswaModel;
    public function __construct()
    {
        $this->siswaModel = new SiswaModel();
        
    }
    public function index()
    {
        $session = session();
        $name = $session->get('name');
        $data['name'] = $name;
        echo view('admin/template_admin/header');
        echo view('admin/template_admin/sidebar_siswa', $data);
        echo view('siswa/index', $data);
        echo view('admin/template_admin/footer');
    }
}
