<?php

namespace App\Models;

use CodeIgniter\Model;

class HierarchyModel extends Model
{
    protected $table            = 'user_hierarchy';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    
    protected $useTimestamps    = true;

    // Menyimpan mapping atasan dan bawahan (Ketentuan 1.c)
    protected $allowedFields    = [
        'id_atasan',
        'id_bawahan'
    ];
    
    // Fungsi bantuan untuk mendapatkan list bawahan
    public function getBawahan($id_atasan)
    {
        return $this->where('id_atasan', $id_atasan)
                    ->join('users', 'users.id = user_hierarchy.id_bawahan')
                    ->findAll();
    }
}