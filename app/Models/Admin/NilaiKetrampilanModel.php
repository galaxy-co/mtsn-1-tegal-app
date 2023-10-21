<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class NilaiKetrampilanModel extends Model
{
    protected $table        = 'nilaiKetrampilan';
    protected $primaryKey = 'id_nilai';

    protected $useAutoIncrement     = true;

    protected $returnType           = 'array';
    protected $useSoftDelete        = false;

    protected $allowedFields        = ['id_siswa', 'id_guru','id_mapel','id_kelas', 'semester', 'tahun_ajaran'];
}
