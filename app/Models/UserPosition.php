<?php

namespace App\Models;

use App\Models\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;

class UserPosition extends Model
{
    use HasUuid;

    protected $primaryKey = 'uuid';
    protected $fillable = [
        'user_id',
        'position_id',
    ];

    // public function user()
    // {
    //     return $this->belongsTo(User::class, 'user_id', 'uuid');
    // }
}
