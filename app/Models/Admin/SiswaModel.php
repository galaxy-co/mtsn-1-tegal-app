<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class SiswaModel extends Model
{
    protected $table        = 'siswa';
    protected $primaryKey = 'id_siswa';

    protected $useAutoIncrement     = true;

    protected $returnType           = 'array';
    protected $useSoftDelete        = false;

    protected $allowedFields        = ['nism', 'nama_siswa', 'jenis_kelamin', 'kelas'];
    // protected $DBGroup          = 'default';
    // protected $table            = 'siswas';
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
