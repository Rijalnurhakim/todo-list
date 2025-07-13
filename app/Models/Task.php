<?php

namespace App\Models;

use App\Models\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasUuid;

    protected $primaryKey = 'uuid';
    protected $fillable = [
        'user_id',
        'todo',
        'start_date',
        'end_date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'uuid');
    }
}
