<?php

namespace App\Models\InternalAudit;

use CodeIgniter\Model;

class IntAuditBondModel extends Model
{
    protected $table            = 'int_audit_bonds';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'user_id', 'license_no', 'organization', 'assignment_date', 'annual_schedule',
        'area_id', 'audit_period', 'objective', 'field_result', 'inspection_date',
        'location_id', 'policy_check', 'policy_note', 'access_check', 'access_note',
        'cctv_check', 'cctv_note', 'finding_desc', 'finding_category', 'impact',
        'recommendation', 'follow_up_plan', 'follow_up_finding', 'root_cause',
        'corrective_action', 'pic', 'schedule', 'follow_up_status', 'implementation_date',
        'action_desc', 'emergency_action', 'status', 'current_level'
    ];
    protected $useTimestamps    = true;
}
