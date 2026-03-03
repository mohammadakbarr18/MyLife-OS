<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    /**
     * Display all todos for the authenticated user.
     */
    public function index()
    {
        $todos = Auth::user()
            ->todos()
            ->orderByRaw("CASE WHEN status = 'pending' THEN 0 ELSE 1 END")
            ->orderBy('created_at', 'desc')
            ->get();

        return view('todo', compact('todos'));
    }

    /**
     * Store a new todo.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'    => 'required|max:255',
            'priority' => 'required|in:high,medium,low', // Lowercase to match DB enum and factory
            'due_date' => 'nullable|date',
        ]);

        Auth::user()->todos()->create([
            'title'    => $validated['title'],
            'priority' => $validated['priority'],
            'due_date' => $validated['due_date'],
            'status'   => 'pending', // Default status
        ]);

        return back()->with('success', 'Task added!');
    }
}
