<?php

namespace App\Observers;

use App\Models\AuditLog;
use App\Models\UserPosition;
use Illuminate\Support\Facades\Auth;

class UserPositionObserver
{
    /**
     * Handle the User Position "created" event.
     */
    public function created(UserPosition $userPosition): void
    {
        AuditLog::create([
            'user_id' => Auth::id(),
            'action' => 'User Position created',
            'model_type' => get_class($userPosition),
            'model_id' => $userPosition->uuid,
            'changes' => json_encode($userPosition->getChanges()),
        ]);
    }

    /**
     * Handle the User Position "updated" event.
     */
    public function updated(UserPosition $userPosition): void
    {

        AuditLog::updated([
            'user_id' => Auth::id(),
            'action' => 'User Position updated',
            'model_type' => get_class($userPosition),
            'model_id' => $userPosition->uuid,
            'changes' => json_encode($userPosition->getChanges()),
        ]);
    }

    /**
     * Handle the User Position "deleted" event.
     */
    public function deleted(UserPosition $userPosition): void
    {

        AuditLog::updated([
            'user_id' => Auth::id(),
            'action' => 'User Position deleted',
            'model_type' => get_class($userPosition),
            'model_id' => $userPosition->uuid,
            'changes' => json_encode($userPosition->getChanges()),
        ]);
    }
}
