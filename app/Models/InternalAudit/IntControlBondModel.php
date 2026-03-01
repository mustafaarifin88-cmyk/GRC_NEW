<?php

namespace App\Models\InternalAudit;

use CodeIgniter\Model;

class IntControlBondModel extends Model
{
    protected $table            = 'int_control_bonds';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'user_id', 'control_name', 'control_objective', 'control_type', 'covered_area',
        'assessment_method', 'assessment_frequency', 'assessment_result',
        'control_to_improve', 'corrective_action', 'pic', 'schedule', 'kci',
        'threshold', 'monitoring_frequency', 'monitoring_result', 'emergency_action',
        'status', 'current_level'
    ];
    protected $useTimestamps    = true;
}
