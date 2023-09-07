<?php
namespace App\Models\Admin;

use CodeIgniter\Model;

class KelasModel extends Model
{
    protected $table        = 'kelas';
    protected $primarikey   = 'id_kelas';

    protected $useAutoIncrement     = true;

    protected $returnType           = 'array';
    protected $useSoftDelete        = false;

    protected $allowedFields        = ['tingkat', 'nama_kelas', 'kurikulum'];
}