<?php

namespace App\Models\InternalAudit;

use CodeIgniter\Model;

class IntComplianceBondModel extends Model
{
    protected $table            = 'int_compliance_bonds';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'user_id', 'regulation_name', 'regulation_no', 'short_desc', 'category',
        'policy_name', 'policy_no', 'issue_date', 'effective_date', 'area_id',
        'assessment_period', 'compliance_status', 'compliance_note', 'gap_note',
        'improvement_plan', 'gap_to_improve', 'corrective_action', 'schedule',
        'improvement_status', 'implementation_date', 'action_desc', 
        'supervisor_verification', 'emergency_action', 'status', 'current_level'
    ];
    protected $useTimestamps    = true;
}
