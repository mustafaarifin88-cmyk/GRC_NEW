<?php

namespace App\Models\InternalAudit;

use CodeIgniter\Model;

class IntIncidentBondModel extends Model
{
    protected $table            = 'int_incident_bonds';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'user_id', 'report_title', 'incident_date', 'location', 'incident_desc',
        'incident_type', 'impact', 'involved_parties', 'emergency_action',
        'analysis_method', 'causal_factor', 'contributing_factor', 'short_term_action',
        'long_term_action', 'pic', 'recovery_steps', 'recovery_cost', 'recovery_time',
        'status', 'current_level'
    ];
    protected $useTimestamps    = true;
}
