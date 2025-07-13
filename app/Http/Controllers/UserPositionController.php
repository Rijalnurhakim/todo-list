<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\AuditLog;
use App\Models\Position;
use Illuminate\View\View;
use App\Models\UserPosition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\UserPositionUpdateRequest;

class UserPositionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        $positions = Position::all();
        $userPositions = UserPosition::with(['user', 'position'])
            ->latest()
            ->get();
        return view('user-position.index', compact('users', 'positions', 'userPositions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        $positions = Position::all();
        return view('user-position.create', compact('users', 'positions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,uuid',
            'position_id' => 'required|exists:positions,uuid',
        ]);

        UserPosition::create([
            'uuid' => (string) \Illuminate\Support\Str::uuid(),
            'user_id' => $request->user_id,
            'position_id' => $request->position_id,
        ]);

        return redirect()->route('user-position.index')->with('status', 'User Position created successfully!');
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
    // public function edit(UserPosition $userPosition): View
    // {
    //     $users = User::all();
    //     $positions = Position::all();
    //     $userPositions = UserPosition::all();
    //     return view('user-position.edit', compact('users', 'positions', 'userPositions'));
    // }

    public function edit($uuid)
    {
        // Gunakan with() untuk eager loading relasi
        $userposition = UserPosition::with(['user', 'position'])
            ->where('uuid', $uuid)
            ->firstOrFail();

        $users = User::all(); // Ambil semua user
        $positions = Position::all(); // Ambil semua position

        return view('user-position.edit', [
            'userposition' => $userposition, // Pastikan nama variabel sama dengan yang di view
            'users' => $users,
            'positions' => $positions
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserPositionUpdateRequest $request, UserPosition $userPosition): RedirectResponse
    {
        // dd($request->all());
        $userPosition->fill($request->validated());

        if ($userPosition->isDirty('user_id') || $userPosition->isDirty('position_id')) {
            $userPosition->save();

            AuditLog::create([
                'user_id' => Auth::id(),
                'action' => 'User Position updated',
                'model_type' => UserPosition::class,
                'model_id' => $userPosition->uuid,
                'changes' => json_encode($userPosition->getChanges()),
            ]);

            return redirect()->route('user-position.index')->with('status', 'User Position updated successfully!');
        }

        return redirect()->route('user-position.edit', $userPosition)->with('status', 'No changes detected.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, UserPosition $userPosition): RedirectResponse
    {

        $userPosition->delete();

        return redirect()->route('user-position.index')->with('status', 'User Position deleted successfully!');
    }
}
