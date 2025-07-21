<?php

namespace App\Observers;

use App\Models\Task;
use App\Models\AuditLog;
use Illuminate\Support\Facades\Auth;

class TaskObserver
{
    /**
     * Handle the Task "created" event.
     */
    public function created(Task $task): void
    {
        AuditLog::create([
            'user_id' => Auth::user()->uuid,
            'action' => 'Task created',
            'model_type' => get_class($task),
            'model_id' => $task->uuid,
            'changes' => json_encode($task->getAttributes()),
        ]);
    }

    /**
     * Handle the Task "updated" event.
     */
    public function updated(Task $task): void
    {

        // AuditLog::updated([
        //     'user_id' => Auth::id(),
        //     'action' => 'Task updates',
        //     'model_type' => get_class($task),
        //     'model_id' => $task->uuid,
        //     'changes' => json_encode($task->getChanges()),
        // ]);

        AuditLog::create([
            'user_id' => Auth::user()->uuid,
            'action' => 'Task updated',
            'model_type' => Task::class,
            'model_id' => $task->uuid,
            'changes' => json_encode($task->getChanges()),
        ]);
    }

    /**
     * Handle the Task "deleted" event.
     */
    public function deleted(Task $task): void
    {

        // AuditLog::updated([
        //     'user_id' => Auth::id(),
        //     'action' => 'Task deleted',
        //     'model_type' => get_class($task),
        //     'model_id' => $task->uuid,
        //     'changes' => json_encode($task->getChanges()),
        // ]);

        AuditLog::create([
            'user_id' => Auth::user()->uuid,
            'action' => 'Task deleted',
            'model_type' => Task::class,
            'model_id' => $task->uuid,
            'changes' => json_encode($task->getOriginal()),
        ]);
    }

    /**
     * Handle the Task "restored" event.
     */
    public function restored(Task $task): void
    {
        //
    }

    /**
     * Handle the Task "force deleted" event.
     */
    public function forceDeleted(Task $task): void
    {
        //
    }
}
