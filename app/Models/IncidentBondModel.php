<?php

namespace App\Models;

use CodeIgniter\Model;

class IncidentBondModel extends Model
{
    protected $table            = 'form_incident_bond';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    
    protected $useTimestamps    = true;

    protected $allowedFields    = [
        'id_report',
        'judul',
        'tanggal_waktu_kejadian',
        'lokasi',
        'deskripsi_kejadian',
        'jenis_insiden',
        'dampak',
        'pihak_terlibat',
        'tindakan_darurat',
        
        // Analisis Akar Masalah (Root Cause Analysis)
        'metode_analisis',
        'faktor_penyebab',
        'faktor_kontributor',
        
        // Tindakan Perbaikan
        'tindakan_jangka_pendek',
        'tindakan_jangka_panjang',
        'penanggung_jawab',
        
        // Pemulihan
        'langkah_pemulihan',
        'biaya_pemulihan',
        'waktu_pemulihan',
        
        'lampiran' // Array/JSON string untuk multi file upload
    ];
}