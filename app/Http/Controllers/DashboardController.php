<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        $tasks = Task::with('user')
            ->where('user_id', Auth::user()->uuid)
            ->oldest()
            ->get();
        return view('dashboard', compact('tasks'));
    }
}
