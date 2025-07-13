<?php

namespace App\Models;

use App\Models\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    use HasUuid;

    protected $primaryKey = 'uuid';
    protected $fillable = [
        'name',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_positions', 'position_id', 'user_id', 'uuid', 'uuid');
    }
}
