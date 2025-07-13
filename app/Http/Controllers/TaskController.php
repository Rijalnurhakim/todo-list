<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use App\Models\AuditLog;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\TaskUpdateRequest;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::with('user')->latest()->get();
        dd($tasks);
        return view('dashboard', compact('tasks'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user-position.create', compact('users'));

        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'todo' => 'required|string',
        ]);

        Task::create([
            'uuid' => (string) \Illuminate\Support\Str::uuid(),
            'user_id' => Auth::user()->uuid,
            'todo' => $request->todo,
        ]);
        // dd($request->all());

        return redirect()->route('tasks.index')->with('status', 'Task created successfully!');
    }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'todo' => 'required|string',
    //     ]);

    //     $dataToCreate = [
    //         'uuid' => (string) \Illuminate\Support\Str::uuid(),
    //         'user_id' => Auth::user('uuid'),
    //         'todo' => $request->todo,
    //     ];

    //     // Debug data sebelum create
    //     dd([
    //         'auth_info' => [
    //             'id' => Auth::id(),
    //             'user' => Auth::user(),
    //         ],
    //         'request_data' => $request->all(),
    //         'data_to_create' => $dataToCreate,
    //         'model_fillable' => (new Task())->getFillable(),
    //         'user_id_type' => gettype(Auth::id()),
    //     ]);

    //     // Task::create($dataToCreate);
    //     // return redirect()->route('tasks.index')->with('status', 'Task created successfully!');
    // }



    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task): View
    {
        return view('tasks.edit', [
            'task' => $task,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaskUpdateRequest $request, Task $task): RedirectResponse
    {
        $task->fill($request->validated());

        if ($task->isDirty('todo')) {
            $task->save();
            // dd($request->all());

            AuditLog::create([
                'user_id' => Auth::id(),
                'action' => 'Task updated',
                'model_type' => Task::class,
                'model_id' => $task->uuid,
                'changes' => json_encode($task->getChanges()),
            ]);

            return redirect()->route('tasks.index')->with('status', 'Task updated successfully!');
        }

        return redirect()->route('tasks.edit', $task->uuid)->with('status', 'No changes made.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Task $task): RedirectResponse
    {
        // $task = Task::findOrFail($request->uuid);
        AuditLog::create([
            'user_id' => Auth::id(),
            'action' => 'Task deleted',
            'model_type' => Task::class,
            'model_id' => $task->uuid,
            'changes' => json_encode($task->getChanges()),
        ]);
        $task->delete();


        return redirect()->route('tasks.index')->with('status', 'Task deleted successfully!');
    }
}
