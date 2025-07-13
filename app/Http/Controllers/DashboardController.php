<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {

        return view('dashboard');
    }

    public function checklist()
    {
        $tasks = Task::with('user')->latest()->get();
        return view('task-checklist', compact('tasks'));
    }
}
