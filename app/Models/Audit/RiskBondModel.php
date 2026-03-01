<?php

namespace App\Models\Audit;

use CodeIgniter\Model;

class RiskBondModel extends Model
{
    protected $table            = 'risk_bonds';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'user_id', 'title', 'risk_desc', 'risk_category', 'assessment_date',
        'cause', 'impact', 'likelihood', 'assessment_method', 'assessment_scale',
        'risk_value', 'risk_level', 'current_mitigation', 'recommended_mitigation', 'status', 'current_level'
    ];
    protected $useTimestamps    = true;
}
