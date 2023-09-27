<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class AbsenModel extends Model
{
    protected $table        = 'absen';
    protected $primaryKey = 'id_absen';

    protected $useAutoIncrement     = true;

    protected $returnType           = 'array';
    protected $useSoftDelete        = false;

    protected $allowedFields        = ['id_siswa', 'sakit', 'izin', 'alpa', 'catatan', 'semester', 'tahun_ajaran'];
    // protected $DBGroup          = 'default';
    // protected $table            = 'absens';
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
