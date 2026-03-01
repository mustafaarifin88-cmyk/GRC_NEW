<?php

namespace App\Models\InternalAudit;

use CodeIgniter\Model;

class IntCyberBondModel extends Model
{
    protected $table            = 'int_cyber_bonds';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'user_id', 'assessed_asset', 'threat', 'vulnerability', 'impact', 'risk_level',
        'control_type', 'control_desc', 'system_log', 'intrusion_detection',
        'vulnerability_analysis', 'penetration_test', 'attack_type', 'attack_target',
        'attack_impact', 'handling_action', 'emergency_action', 'status', 'current_level'
    ];
    protected $useTimestamps    = true;
}
