<?php

namespace App\Models\InternalAudit;

use CodeIgniter\Model;

class IntContinuityBondModel extends Model
{
    protected $table            = 'int_continuity_bonds';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'user_id', 'critical_process', 'financial_impact', 'operational_impact',
        'rto', 'rpo', 'backup_location', 'recovery_procedure', 'recovery_team',
        'emergency_contact', 'business_continuity_strategy', 'alternative_procedure',
        'continuity_team', 'test_date', 'test_scenario', 'test_result', 'improvement',
        'emergency_action', 'status', 'current_level'
    ];
    protected $useTimestamps    = true;
}
