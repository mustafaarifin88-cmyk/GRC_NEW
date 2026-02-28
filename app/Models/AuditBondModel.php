<?php

namespace App\Models;

use CodeIgniter\Model;

class AuditBondModel extends Model
{
    protected $table            = 'form_audit_bond';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    
    protected $useTimestamps    = true;

    protected $allowedFields    = [
        'id_report',            // Relasi ke tabel report_submissions
        'judul',
        'area_audit',           // Dari Master Data Area
        'tanggal_audit',
        
        // Ceklis & File Bukti (Ketentuan 2.a.1)
        'chk_kebijakan', 'file_kebijakan', 'catatan_kebijakan',
        'chk_akses', 'file_akses', 'catatan_akses',
        'chk_cctv', 'file_cctv', 'catatan_cctv',
        
        // Temuan
        'deskripsi_temuan',
        'kategori_temuan',      // Pelanggaran Kebijakan, Kelemahan Kontrol, dll
        'dampak',               // Rendah, Sedang, Tinggi
        'rekomendasi',
        'bukti_lainnya'         // Bisa menyimpan array string JSON untuk multi file
    ];
}