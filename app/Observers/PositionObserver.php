<?php

namespace App\Observers;

use App\Models\AuditLog;
use App\Models\Position;
use Illuminate\Support\Facades\Auth;

class PositionObserver
{
    /**
     * Handle the Position "created" event.
     */
    public function created(Position $position): void
    {
        AuditLog::create([
            'user_id' => Auth::id(),
            'action' => 'Position created',
            'model_type' => get_class($position),
            'model_id' => $position->uuid,
            'changes' => json_encode($position->getAttributes()),
        ]);
    }

    /**
     * Handle the Position "updated" event.
     */
    public function updated(Position $position): void
    {

        // AuditLog::updated([
        //     'user_id' => Auth::id(),
        //     'action' => 'Position updated',
        //     'model_type' => get_class($position),
        //     'model_id' => $position->uuid,
        //     'changes' => json_encode($position->getChanges()),
        // ]);

        AuditLog::create([
            'user_id' => Auth::id(),
            'action' => 'Position updated',
            'model_type' => Position::class,
            'model_id' => $position->uuid,
            'changes' => json_encode($position->getChanges()),
        ]);
    }

    /**
     * Handle the Position "deleted" event.
     */
    public function deleted(Position $position): void
    {

        // AuditLog::updated([
        //     'user_id' => Auth::id(),
        //     'action' => 'Position deleted',
        //     'model_type' => get_class($position),
        //     'model_id' => $position->uuid,
        //     'changes' => json_encode($position->getChanges()),
        // ]);

        AuditLog::create([
            'user_id' => Auth::id(),
            'action' => 'Position deleted',
            'model_type' => Position::class,
            'model_id' => $position->uuid,
            'changes' => json_encode($position->getOriginal()),
        ]);
    }
}
