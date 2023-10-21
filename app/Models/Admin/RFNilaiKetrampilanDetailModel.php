<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class RFNilaiKetrampilanDetailModel extends Model
{
    protected $table        = 'rfNilaiDetailKetrampilan';
    protected $primaryKey = 'rf_nilai_detail_id';

    protected $useAutoIncrement     = true;

    protected $returnType           = 'array';
    protected $useSoftDelete        = false;

    protected $allowedFields        = ['rf_nilai_detail_desc', 'kurikulum_id'];
}
