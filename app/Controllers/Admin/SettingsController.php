<?php

namespace App\Controllers\Admin;
use App\Models\Admin\SettingsModel;

use App\Controllers\BaseController;

class SettingsController extends BaseController
{
    protected $settingModel;

    public function __construct()
    {
        $this->settingModel = new SettingsModel();
    }
    public function index()
    {
        $data['settings'] = $this->settingModel->first();
        echo view('admin/template_admin/header');
        echo view('admin/template_admin/sidebar');
        echo view('admin/settings', $data);
        echo view('admin/template_admin/footer');
    }
    public function add()
    {
        $kepsek = $this->request->getPost('nama_kepsek');
        $semester = $this->request->getPost('semester');
        $tglCetak = $this->request->getPost('tanggal_cetak_raport');
        $ta = $this->request->getPost('tahun_ajaran1') . '/' . $this->request->getPost('tahun_ajaran2');;

        $data = [
            'nama_kepsek' => $kepsek,
            'semester' => $semester,
            'tahun_ajaran' => $ta,
            'tanggal_cetak_raport' => $tglCetak
        ];
        $this->settingModel->save($data);
        session()->setFlashdata('success', 'Berhasil Simpan Settings');
        return redirect()->to('/admin/settings');
    }
    public function edit($id)
    {
        $data['settings'] = $this->settingModel->where('id_settings', $id)->first();
        echo view('admin/template_admin/header');
        echo view('admin/template_admin/sidebar');
        echo view('admin/settingsEdit', $data);
        echo view('admin/template_admin/footer');
    }
    public function update($id)
    {

        $kepsek = $this->request->getPost('nama_kepsek');
        $semester = $this->request->getPost('semester');
        $tglCetak = $this->request->getPost('tanggal_cetak_raport');
        $ta = $this->request->getPost('tahun_ajaran1') . '/' . $this->request->getPost('tahun_ajaran2');;

        $data = [
            'nama_kepsek' => $kepsek,
            'semester' => $semester,
            'tahun_ajaran' => $ta,
            'tanggal_cetak_raport' => $tglCetak
        ];
        $this->settingModel->update($id, $data);

        session()->setFlashdata('success', 'Berhasil Update Settings');
        return redirect()->to('/admin/settings');
    }
}
