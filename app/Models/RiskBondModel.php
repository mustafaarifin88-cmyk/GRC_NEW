<?php

namespace App\Models;

use CodeIgniter\Model;

class RiskBondModel extends Model
{
    protected $table            = 'form_risk_bond';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    
    protected $useTimestamps    = true;

    protected $allowedFields    = [
        'id_report',
        'judul',
        'deskripsi_risiko',
        'kategori_risiko',       // Operasional, Keuangan, Reputasi, Kepatuhan
        'tanggal_penilaian',
        
        // Analisis Risiko (Ketentuan 2.a.3)
        'penyebab',
        'dampak',
        'kemungkinan_terjadi',   // Sangat Rendah - Sangat Tinggi
        
        // Penilaian
        'metode_penilaian',      // Kualitatif, Kuantitatif
        'skala_penilaian',       // 1-5 atau 1-10
        'nilai_risiko',
        'tingkat_risiko',        // Otomatis (Rendah, Sedang, Tinggi)
        
        // Mitigasi
        'mitigasi_sudah',
        'mitigasi_tambahan',
        'bukti'                  // JSON String untuk file multiple
    ];
}