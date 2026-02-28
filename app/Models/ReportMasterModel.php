<?php

namespace App\Models;

use CodeIgniter\Model;

class ReportMasterModel extends Model
{
    // Ini adalah tabel transaksional UTAMA untuk mengontrol workflow laporan
    protected $table            = 'report_submissions';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    
    protected $useTimestamps    = true;

    protected $allowedFields    = [
        'id_user_staff',   // Siapa yang membuat laporan
        'jenis_form',      // cth: 'audit_bond', 'risk_bond', dll
        'id_dokumen',      // ID pada tabel form spesifiknya (misal id di tabel form_audit_bond)
        'status_approval', // PROSES, APPROVED, REJECTED
        'posisi_approval', // KEPALA UNIT, SUPERVISOR, MANAGERIAL, PIMPINAN TINGGI
        'alasan_tolak',    // Terisi jika ditolak (Ketentuan 3.6)
        'ditolak_oleh'     // Menyimpan ID/Level yang menolak
    ];
}