<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\AuditLog;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUpdateRequest;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {

        $user = $request->user();
        $user->fill($request->validated());

        if ($user->isDirty('username')) {
            $user->save();

            AuditLog::create([
                'user_id' => Auth::id(),
                'action' => 'Username updated',
                'model_type' => User::class,
                'model_id' => $user->uuid,
                'changes' => json_encode($user->getChanges()),
            ]);

            Auth::logout();

            return Redirect::route('login')->with('status', 'username berhasil diperbarui, silakan login kembali');
        }

        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request, User $user): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        AuditLog::create([
            'user_id' => Auth::id(),
            'action' => 'User deleted',
            'model_type' => User::class,
            'model_id' => $user->uuid,
            'changes' => json_encode($user->getOriginal()),
        ]);

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
