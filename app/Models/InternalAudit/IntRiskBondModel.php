<?php

namespace App\Models\InternalAudit;

use CodeIgniter\Model;

class IntRiskBondModel extends Model
{
    protected $table            = 'int_risk_bonds';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'user_id', 'risk_title', 'risk_desc', 'risk_category', 'cause', 'impact',
        'likelihood', 'risk_level', 'assessment_period', 'assessment_method',
        'mitigated_risk_value', 'mitigated_risk', 'mitigation_action', 'pic',
        'schedule', 'cost', 'kri', 'threshold', 'monitoring_frequency', 'monitoring_result',
        'follow_up_action', 'emergency_action', 'status', 'current_level'
    ];
    protected $useTimestamps    = true;
}
