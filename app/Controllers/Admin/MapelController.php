<?php

namespace App\Controllers\Admin;
use App\Models\Admin\MapelModel;
use App\Controllers\BaseController;


class MapelController extends BaseController
{
    protected $MapelModel;
    public function __construct()
    {
        $this->MapelModel = new MapelModel();
    }
    public function index($id=null)
    {
        $data['guru'] = $this->MapelModel->findAll();
        echo view('template/header');
        echo view('template/sidebar');
        echo view('user/index', $data);
        echo view('template/footer');
    }

    public function store(){
        
    }

}
