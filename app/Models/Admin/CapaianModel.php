<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class CapaianModel extends Model
{
    protected $table        = 'capaian_p5';
    protected $primaryKey = 'id_capaian';

    protected $useAutoIncrement     = true;

    protected $returnType           = 'array';
    protected $useSoftDelete        = false;

    protected $allowedFields        = ['kode_capaian','id_parent_element','desc','nilai_rahmatan_lil_alamin','sub_nilai'];
    // protected $DBGroup          = 'default';
    // protected $table            = 'gurus';
    // protected $primaryKey       = 'id';
    // protected $useAutoIncrement = true;
    // protected $returnType       = 'array';
    // protected $useSoftDeletes   = false;
    // protected $protectFields    = true;
    // protected $allowedFields    = [];

    // // Dates
    // protected $useTimestamps = false;
    // protected $dateFormat    = 'datetime';
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    // // Validation
    // protected $validationRules      = [];
    // protected $validationMessages   = [];
    // protected $skipValidation       = false;
    // protected $cleanValidationRules = true;

    // // Callbacks
    // protected $allowCallbacks = true;
    // protected $beforeInsert   = [];
    // protected $afterInsert    = [];
    // protected $beforeUpdate   = [];
    // protected $afterUpdate    = [];
    // protected $beforeFind     = [];
    // protected $afterFind      = [];
    // protected $beforeDelete   = [];
    // protected $afterDelete    = [];
}
