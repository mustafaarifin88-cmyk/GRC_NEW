<?php

namespace App\Models;

use CodeIgniter\Model;

class FileDataModel extends Model
{
    protected $table            = 'file_data';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['related_table', 'related_id', 'file_name', 'file_path', 'file_type'];
    protected $useTimestamps    = true;
}
