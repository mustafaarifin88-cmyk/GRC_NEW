<?php

namespace App\Models;

use CodeIgniter\Model;

class ReportModel extends Model
{
    // Sesuaikan nama tabel dengan database_grc.sql
    protected $table            = 'report_submissions';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    
    // Sesuaikan kolom dengan struktur tabel report_submissions
    protected $allowedFields    = [
        'id_user_staff',
        'jenis_form',
        'id_dokumen',
        'status_approval',
        'posisi_approval',
        'alasan_tolak',
        'ditolak_oleh'
    ];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}