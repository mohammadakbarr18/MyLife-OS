<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class TodoController extends Controller
{
    /**
     * Display all todos for the authenticated user.
     */
    public function index()
    {
        $todos = Auth::user()
            ->todos()
            ->with('taskPriority')
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
        $user = $request->user();

        $validated = $request->validate([
            'title' => 'required|max:255',
            'task_priority_id' => [
                'required',
                Rule::exists('task_priorities', 'id')->where(fn ($query) => $query->where('user_id', $user->id)),
            ],
            'due_date' => 'nullable|date',
        ]);

        $user->todos()->create([
            'title' => $validated['title'],
            'task_priority_id' => $validated['task_priority_id'],
            'due_date' => $validated['due_date'],
            'status' => 'pending',
        ]);

        return back()->with('success', 'Tugas berhasil ditambahkan!');
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
            'title' => 'required|max:255',
            'task_priority_id' => [
                'required',
                Rule::exists('task_priorities', 'id')->where(fn ($query) => $query->where('user_id', $request->user()->id)),
            ],
            'due_date' => 'nullable|date',
        ]);

        $todo->update([
            'title' => $validated['title'],
            'task_priority_id' => $validated['task_priority_id'],
            'due_date' => $validated['due_date'],
        ]);

        return back()->with('success', 'Tugas berhasil diperbarui!');
    }

    /**
     * Delete a todo.
     */
    public function destroy(Todo $todo)
    {
        abort_unless($todo->user_id === Auth::id(), 403);

        $todo->delete();

        return back()->with('success', 'Tugas berhasil dihapus!');
    }
}
