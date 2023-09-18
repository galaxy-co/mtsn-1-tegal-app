<?php

namespace App\Controllers\Admin;
use App\Models\Admin\NilaiModel;
use App\Models\Admin\KelasModel;
use App\Models\Admin\GuruModel;
use App\Models\Admin\MapelModel;
use App\Models\Admin\SiswaModel;
use App\Models\Admin\PASModel;
use App\Models\Admin\TypeTestModel;
use App\Controllers\BaseController;
use App\Database\Migrations\Mapel;

class PASController extends BaseController
{
    protected $nilaiModel;
    protected $kelasModel;
    protected $guruModel;
    protected $mapelModel;
    protected $siswaModel;
    protected $pasModel;
    protected $typeTestModel;

    public function __construct(){
        $this->nilaiModel = new NilaiModel();
        $this->kelasModel = new KelasModel();
        $this->guruModel = new GuruModel();
        $this->mapelModel = new MapelModel();
        $this->siswaModel = new SiswaModel();
        $this->pasModel = new PASModel();
        $this->typeTestModel = new TypeTestModel();
    }
    public function index()
    {
        
        $data['nilai_pas'] = $this->pasModel
            ->join('kelas','kelas.id_kelas = nilai_pas.id_kelas')
            ->join('mapel','mapel.id_mapel = nilai_pas.id_mapel')
            ->join('guru','guru.id_guru = nilai_pas.id_guru')
            ->groupBy('nilai_pas.id_kelas')
            ->groupBy('nilai_pas.id_mapel')
            ->findAll();
        $data['kelas'] = $this->kelasModel->findAll();
        $data['guru'] = $this->guruModel->findAll();
        $data['mapel'] = $this->mapelModel->findAll();
        echo view('admin/template_admin/header');
        echo view('admin/template_admin/sidebar');
        echo view('admin/pas', $data);
        echo view('admin/template_admin/footer');
    }
    public function detail(){
        $dataInput = $this->request->getVar();
        // $siswa = $this->siswaModel
        //     ->join('nilai_pas','siswa.id_siswa = nilai_pas.id_siswa','left')
        //     ->join('mapel','mapel.id_mapel = nilai_pas.id_mapel','left')
        //     ->join('kelas','kelas.id_kelas = nilai_pas.id_kelas','left')
        //     ->where('kelas.id_kelas',$dataInput['id_kelas'])
        //     ->findAll();
        
        
            $kelas = $this->kelasModel->where('id_kelas', $dataInput['id_kelas'])->first();
            $kurikulum = $kelas['kurikulum'];
            $siswa = $this->siswaModel->where('kelas', $dataInput['id_kelas'])->findAll();
            // var_dump($siswa); die;
            $data['kelas'] = $this->kelasModel->where('id_kelas', $dataInput['id_kelas'])->first();
            $data['guru'] = $this->guruModel->where('id_guru', $dataInput['id_guru'])->first();
            $data['mapel'] = $this->mapelModel->where('id_mapel', $dataInput['id_mapel'])->first();
            $data['siswa'] = $siswa;

            echo view('admin/template_admin/header');
            echo view('admin/template_admin/sidebar');
            echo view('admin/detail_pas', $data);
            echo view('admin/template_admin/footer');
    }
    public function store()
    {
        $idGuru = $this->request->getPost('id_guru');
        $idKelas = $this->request->getPost('id_kelas');
        $idMapel = $this->request->getPost('id_mapel');

        $array_idSiswa = $this->request->getPost('id_siswa');
        $array_nilai = $this->request->getPost('nilai');

        foreach ($array_idSiswa as $key => $id_siswa) {
            $data = [
                'id_guru' => $idGuru,
                'id_kelas' => $idKelas,
                'id_mapel' => $idMapel,
                'id_siswa' => $id_siswa,
                'nilai' => $array_nilai[$key],
                'type_test' => 1
            ];
    
            $this->pasModel->save($data);
        }
        
        session()->setFlashdata('success', 'Nilai Berhasil Disimpan');

        return redirect()->to('/admin/pas');
        
    }
    public function edit($id){
        $nilai = $this->pasModel->where('id_nilai_pas', $id)->first();
        $kelas = $nilai['id_kelas'];
        $mapel = $nilai['id_mapel'];

        $data['nilai_pas'] = $this->pasModel
                            ->join('kelas', 'kelas.id_kelas = nilai_pas.id_kelas')
                            ->join('siswa', 'siswa.id_siswa = nilai_pas.id_siswa')
                            ->join('mapel', 'mapel.id_mapel = nilai_pas.id_mapel')
                            ->join('guru', 'guru.id_guru = nilai_pas.id_guru')
                            ->where('nilai_pas.id_kelas', $kelas)
                            ->where('nilai_pas.id_mapel', $mapel)
                            ->findAll();
        echo view('admin/template_admin/header');
        echo view('admin/template_admin/sidebar');
        echo view('admin/edit_pas', $data);
        echo view('admin/template_admin/footer');

    }

    public function update()
    {
        $array_idNilaiPas = $this->request->getPost('id_nilai_pas');
        $array_nilai = $this->request->getPost('nilai');
 

        foreach($array_idNilaiPas as $key => $idNilaiPas){
            $data = [
                'nilai' => $array_nilai[$key]
            ];
            $this->pasModel->update($idNilaiPas, $data);
        }
        session()->setFlashdata('success', 'Update NIlai');

        return redirect()->to('/admin/pas');
        
    }
}
