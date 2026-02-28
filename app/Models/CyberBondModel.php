<?php

namespace App\Models;

use CodeIgniter\Model;

class CyberBondModel extends Model
{
    protected $table            = 'form_cyber_bond';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    
    protected $useTimestamps    = true;

    protected $allowedFields    = [
        'id_report',
        
        // Penilaian Risiko Keamanan Siber
        'aset_dinilai',
        'ancaman',
        'kerentanan',
        'dampak_risiko',
        'tingkat_risiko',
        
        // Kontrol Keamanan
        'jenis_kontrol',        // Teknis, Administratif, Fisik
        'deskripsi_kontrol',
        
        // Pemantauan Keamanan
        'log_sistem',
        'deteksi_intrusi',
        'analisis_kerentanan',
        'uji_penetrasi',
        
        // Insiden Keamanan Siber
        'jenis_serangan',
        'target_serangan',
        'dampak_insiden',
        'tindakan_penanganan',
        'tindakan_darurat',
        
        'lampiran' // Array/JSON string untuk multi file upload
    ];
}