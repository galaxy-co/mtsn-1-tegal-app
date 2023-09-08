<?php

namespace App\Controllers\Admin;
use App\Models\Admin\MapelModel;
use App\Controllers\BaseController;

class MapelController extends BaseController
{
    protected $mapelModel;
    public function __construct()
    {
        $this->mapelModel = new MapelModel();
    }
    public function index()
    {
        $data['mapel'] = $this->mapelModel->findAll();
        echo view('admin/template_admin/header');
        echo view('admin/template_admin/sidebar');
        echo view('admin/mapel_in_admin', $data);
        echo view('admin/template_admin/footer');
    }
    public function addMapel()
    {
        $data = $this->request->getPost();;

        $this->mapelModel->save($data);

        session()->setFlashdata('success', 'Memasukan Mapel');

        return redirect()->to('/admin/mapel');
    }
    public function deleteMapel($id)
    {
        $id = intval($id);
        $this->mapelModel->delete($id);

        session()->setFlashdata('success', 'Sukses Hapus Data');

        return redirect()->to('/admin/mapel');
    }
    public function edit($id){
        die('Edit Will Be Here');
    }
}
