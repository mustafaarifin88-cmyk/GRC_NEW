<?php

namespace App\Models;

use CodeIgniter\Model;

class ControlBondModel extends Model
{
    protected $table            = 'form_control_bond';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    
    protected $useTimestamps    = true;

    protected $allowedFields    = [
        'id_report',
        
        // Informasi Kontrol
        'nama_kontrol',
        'tujuan_kontrol',
        'jenis_kontrol',        // Preventif, Detektif, Korektif
        'area_dicakup',
        
        // Penilaian Efektivitas Kontrol
        'metode_penilaian',
        'frekuensi_penilaian',
        'hasil_penilaian',
        'bukti_penilaian',      // Untuk upload bukti tahap penilaian (bisa JSON string)
        
        // Tindakan Perbaikan Kontrol
        'kontrol_diperbaiki',
        'tindakan_perbaikan',
        'penanggung_jawab',
        'jadwal_pelaksanaan',
        
        // Pemantauan Kontrol
        'kci',                  // Key Control Indicators
        'ambang_batas',
        'frekuensi_pemantauan',
        'hasil_pemantauan',
        'tindakan_darurat',
        
        'lampiran' // Array/JSON string untuk multi file upload tahap pemantauan
    ];
}