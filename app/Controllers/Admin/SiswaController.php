<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class SiswaController extends BaseController
{
    public function index()
    {
        echo view('admin/template_admin/header');
        echo view('admin/template_admin/sidebar');
        echo view('admin/siswa_in_admin');
        echo view('admin/template_admin/footer');
    }
}
