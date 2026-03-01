<?php

namespace App\Models\Audit;

use CodeIgniter\Model;

class IncidentReportModel extends Model
{
    protected $table            = 'incident_reports';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'user_id', 'title', 'incident_date', 'location_id', 
        'incident_desc', 'incident_type', 'impact', 'involved_parties', 
        'emergency_action', 'status', 'current_level'
    ];
    protected $useTimestamps    = true;
}
