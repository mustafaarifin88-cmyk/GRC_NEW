<?php

namespace App\Models\Audit;

use CodeIgniter\Model;

class ComplianceBondModel extends Model
{
    protected $table            = 'compliance_bonds';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'user_id', 'title', 'area_id', 'assessment_period', 'assessment_date',
        'license_check', 'license_note', 'safety_check', 'safety_note',
        'tax_check', 'tax_note', 'gap_desc', 'impact', 'recommendation', 'status', 'current_level'
    ];
    protected $useTimestamps    = true;
}
