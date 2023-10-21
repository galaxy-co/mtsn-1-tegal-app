<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class NilaiKetrampilanDetailModel extends Model
{
    protected $table        = 'nilaiKetrampilanDetail';
    protected $primaryKey = 'nilai_detail_id';

    protected $useAutoIncrement     = true;

    protected $returnType           = 'array';
    protected $useSoftDelete        = false;

    protected $allowedFields        = ['id_nilai', 'kd_name','rf_nilai_detail_id','nilai','notes'];
}
