<?php

namespace App\Controllers;

class AdminController extends BaseController
{
    public function index()
    {
        echo view('admin/template_admin/header');
        echo view('admin/template_admin/sidebar');
        echo view('admin/index');
        echo view('admin/template_admin/footer');
    }

}