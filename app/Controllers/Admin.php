<?php

namespace App\Controllers;

class Admin extends BaseController
{
    public function index()
    {
        echo view('admin/template_admin/header');
        echo view('admin/template_admin/navbar');
        echo view('admin/template_admin/sidebar');
        echo view('admin/index');
        echo view('admin/template_admin/footer');
    }
}