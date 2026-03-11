<?php

namespace App\Http\Controllers;

use App\Models\Todo;
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

    /**
     * Toggle a todo's completion status (AJAX).
     */
    public function toggle(Todo $todo)
    {
        abort_unless($todo->user_id === Auth::id(), 403);

        $todo->status = $todo->status === 'completed' ? 'pending' : 'completed';
        $todo->save();

        return response()->json([
            'success'      => true,
            'is_completed' => $todo->status === 'completed',
        ]);
    }

    /**
     * Update an existing todo.
     */
    public function update(Request $request, Todo $todo)
    {
        abort_unless($todo->user_id === Auth::id(), 403);

        $validated = $request->validate([
            'title'    => 'required|max:255',
            'priority' => 'required|in:high,medium,low',
            'due_date' => 'nullable|date',
        ]);

        $todo->update([
            'title'    => $validated['title'],
            'priority' => $validated['priority'],
            'due_date' => $validated['due_date'],
        ]);

        return back()->with('success', 'Task updated successfully!');
    }

    /**
     * Delete a todo.
     */
    public function destroy(Todo $todo)
    {
        abort_unless($todo->user_id === Auth::id(), 403);

        $todo->delete();

        return back()->with('success', 'Task deleted successfully!');
    }
}
