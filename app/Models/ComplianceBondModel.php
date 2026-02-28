<?php

namespace App\Models;

use CodeIgniter\Model;

class ComplianceBondModel extends Model
{
    protected $table            = 'form_compliance_bond';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    
    protected $useTimestamps    = true;

    protected $allowedFields    = [
        'id_report',
        'judul',
        'area_penilaian',
        'periode_penilaian',    // Bulanan, Kuartalan, Tahunan
        'tanggal_penilaian',
        
        // Ceklis Persyaratan (Ketentuan 2.a.2)
        'chk_izin', 'file_izin', 'catatan_izin',
        'chk_keselamatan', 'file_keselamatan', 'catatan_keselamatan',
        'chk_pajak', 'file_pajak', 'catatan_pajak',
        
        // Celah Kepatuhan
        'deskripsi_celah',
        'dampak',               // Rendah, Sedang, Tinggi
        'rekomendasi'
    ];
}