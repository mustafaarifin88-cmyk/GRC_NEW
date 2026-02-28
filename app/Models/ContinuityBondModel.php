<?php

namespace App\Models;

use CodeIgniter\Model;

class ContinuityBondModel extends Model
{
    protected $table            = 'form_continuity_bond';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    
    protected $useTimestamps    = true;

    protected $allowedFields    = [
        'id_report',
        
        // Analisis Dampak Bisnis (BIA)
        'proses_bisnis_kritis',
        'dampak_keuangan',
        'dampak_operasional',
        'rto',                  // Recovery Time Objective
        'rpo',                  // Recovery Point Objective
        
        // Rencana Pemulihan Bencana (DRP)
        'lokasi_cadangan',
        'prosedur_pemulihan',
        'tim_pemulihan',
        'kontak_darurat',
        
        // Rencana Kelangsungan Bisnis (BCP)
        'strategi_kelangsungan',
        'prosedur_alternatif',
        'tim_kelangsungan',
        
        // Uji Coba Rencana
        'tanggal_uji_coba',
        'skenario',
        'hasil_uji_coba',
        'perbaikan',
        'tindakan_darurat',
        
        'lampiran' // Array/JSON string untuk multi file upload
    ];
}