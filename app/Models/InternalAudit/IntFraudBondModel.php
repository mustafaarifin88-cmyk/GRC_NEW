<?php

namespace App\Models\InternalAudit;

use CodeIgniter\Model;

class IntFraudBondModel extends Model
{
    protected $table            = 'int_fraud_bonds';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'user_id', 'report_title', 'report_date', 'reporter_type', 'suspected_party',
        'incident_desc', 'loss_value', 'conclusion', 'corrective_action',
        'disciplinary_action', 'legal_action', 'system_improvement', 'control_improvement',
        'emergency_action', 'status', 'current_level'
    ];
    protected $useTimestamps    = true;
}
