<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model as Eloquent;

class AuditLog extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'audit_logs';

    protected $fillable = [
        'user_id',
        'action',
        'model_type',
        'model_id',
        'changes',
    ];
}
