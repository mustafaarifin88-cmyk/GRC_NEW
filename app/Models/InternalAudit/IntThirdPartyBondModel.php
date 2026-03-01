<?php

namespace App\Models\InternalAudit;

use CodeIgniter\Model;

class IntThirdPartyBondModel extends Model
{
    protected $table            = 'int_third_party_bonds';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'user_id', 'company_name', 'service_type', 'contact', 'start_date', 'end_date',
        'risk_type', 'risk_level', 'due_diligence', 'security_clause', 'compliance_clause',
        'audit_clause', 'kpi', 'performance_report', 'audit', 'review',
        'emergency_action', 'status', 'current_level'
    ];
    protected $useTimestamps    = true;
}
