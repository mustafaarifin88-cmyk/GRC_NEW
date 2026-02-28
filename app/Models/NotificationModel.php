<?php

namespace App\Models;

use CodeIgniter\Model;

class NotificationModel extends Model
{
    protected $table            = 'notifications';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    
    protected $useTimestamps    = true;

    // Tabel untuk menyimpan notifikasi (seperti laporan ditolak/di-approve)
    protected $allowedFields    = [
        'id_user',       // User yang menerima notifikasi
        'judul',
        'pesan',
        'link',          // URL untuk di-klik
        'is_read'        // 0 = belum dibaca, 1 = sudah dibaca
    ];
}