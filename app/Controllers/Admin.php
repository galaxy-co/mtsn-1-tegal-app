<?php

namespace App\Controllers;


class Admin extends BaseController
{
    public function index()
    {
        echo view('admin/template_admin/header');
        echo view('admin/template_admin/sidebar');
        echo view('admin/index');
        echo view('admin/template_admin/footer');
    }

    public function siswa()
    {

        echo view('admin/template_admin/header');
        echo view('admin/template_admin/sidebar');
        echo view('admin/siswa_in_admin');
        echo view('admin/template_admin/footer');
    }
    public function kelas()
    {

        echo view('admin/template_admin/header');
        echo view('admin/template_admin/sidebar');
        echo view('admin/kelas_in_admin');
        echo view('admin/template_admin/footer');
    }

    public function addKelas(){
        $data = $this->request->getPost();
        var_dump($data);
        die;
    }
}