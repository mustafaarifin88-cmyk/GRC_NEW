<?php

namespace App\Models;

use CodeIgniter\Model;

class CompanyModel extends Model
{
    protected $table            = 'profil_perusahaan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    
    protected $useTimestamps    = true;

    // Profil perusahaan sesuai ketentuan
    protected $allowedFields    = [
        'nama_perusahaan',
        'alamat',
        'nama_pimpinan',
        'logo'
    ];
}