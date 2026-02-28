<?php

namespace App\Models;

use CodeIgniter\Model;

class ThirdPartyBondModel extends Model
{
    protected $table            = 'form_third_party_bond';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    
    protected $useTimestamps    = true;

    protected $allowedFields    = [
        'id_report',
        
        // Daftar Pihak Ketiga
        'nama_perusahaan',
        'jenis_layanan',
        'kontak',
        'tanggal_mulai_kontrak',
        'tanggal_berakhir_kontrak',
        
        // Penilaian Risiko Pihak Ketiga
        'jenis_risiko',         // Operasional, Keuangan, Reputasi, Kepatuhan
        'tingkat_risiko',
        'due_diligence',
        
        // Kontrak
        'klausul_keamanan',
        'klausul_kepatuhan',
        'klausul_audit',
        
        // Pemantauan Kinerja Pihak Ketiga
        'kpi',
        'laporan_kinerja',
        'audit_review',
        'tindakan_darurat',
        
        'lampiran' // Array/JSON string untuk multi file upload
    ];
}