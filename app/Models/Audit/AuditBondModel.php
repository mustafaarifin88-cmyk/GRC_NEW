<?php

namespace App\Models\Audit;

use CodeIgniter\Model;

class AuditBondModel extends Model
{
    protected $table            = 'audit_bonds';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'user_id', 'title', 'area_id', 'audit_date', 
        'policy_check', 'policy_note', 'access_check', 'access_note', 
        'cctv_check', 'cctv_note', 'finding_desc', 'finding_category', 
        'impact', 'recommendation', 'status', 'current_level'
    ];
    protected $useTimestamps    = true;
}
