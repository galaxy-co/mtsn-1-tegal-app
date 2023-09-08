<?php

namespace App\Controllers\Admin;
use App\Models\Admin\UserModel;
use App\Controllers\BaseController;


class UserController extends BaseController
{
    protected $userModel;
    public function __construct()
    {
        $this->userModel = new UserModel();
    }
    public function index($id=null)
    {
        $data['guru'] = $this->userModel->findAll();
        echo view('template/header');
        echo view('template/sidebar');
        echo view('user/index', $data);
        echo view('template/footer');
    }

    public function store(){
        
    }

}
