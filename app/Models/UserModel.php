<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    
    // Aktifkan timestamp agar CI4 otomatis mengisi created_at & updated_at
    protected $useTimestamps    = true;
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';

    // Kolom-kolom yang boleh diisi melalui script (mass assignment)
    protected $allowedFields    = [
        'nama_lengkap',
        'username',
        'password',
        'level', // ADMIN, PIMPINAN TINGGI, MANAGERIAL, SUPERVISOR, KEPALA UNIT, STAFF
        'foto'
    ];

    // Fungsi untuk memverifikasi password
    public function verifyPassword($password, $hash)
    {
        return password_verify($password, $hash);
    }
}