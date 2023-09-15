<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class TypeTestModel extends Model
{
    protected $table        = 'type_test';
    protected $primaryKey = 'type_test_id';

    protected $useAutoIncrement     = true;

    protected $returnType           = 'array';
    protected $useSoftDelete        = false;

    protected $allowedFields        = ['type_test_desc'];
    // protected $DBGroup          = 'default';
    // protected $table            = 'typetests';
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
