<?php

namespace App\Models;

use CodeIgniter\Model;

class ApprovalLogModel extends Model
{
    protected $table            = 'approval_logs';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['report_id', 'report_type', 'user_id', 'status', 'reason'];
    protected $useTimestamps    = true;
}
