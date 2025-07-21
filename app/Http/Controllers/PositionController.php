<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;
use App\Models\Position;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\PositionUpdateRequest;

class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $positions = Position::with('users')->latest()->get();
        return view('position.index', compact('positions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('position.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        Position::create([
            'uuid' => (string) \Illuminate\Support\Str::uuid(),
            'user_id' => Auth::id(),
            'name' => $request->name,
        ]);

        return redirect()->route('position.index')->with('status', 'Position created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Position $position): View
    {
        return view('position.edit', [
            'position' => $position,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PositionUpdateRequest $request, Position $position): RedirectResponse
    {
        $position->fill($request->validated());

        if ($position->isDirty('name')) {
            $position->save();

            // AuditLog::create([
            //     'user_id' => Auth::id(),
            //     'action' => 'Position updated',
            //     'model_type' => Position::class,
            //     'model_id' => $position->uuid,
            //     'changes' => json_encode($position->getChanges()),
            // ]);

            return redirect()->route('position.index')->with('status', 'Position updated successfully!');
        }

        return redirect()->route('position.edit', $position)->with('status', 'No changes made.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Position $position): RedirectResponse
    {
        $position->delete();

        // AuditLog::create([
        //     'user_id' => Auth::id(),
        //     'action' => 'Position deleted',
        //     'model_type' => Position::class,
        //     'model_id' => $position->uuid,
        //     'changes' => json_encode($position->getOriginal()),
        // ]);

        return redirect()->route('position.index')->with('status', 'Position deleted successfully!');
    }
}
