<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\TaskPriority;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class SettingsController extends Controller
{
    /**
     * Display the settings page with user categories.
     */
    public function index()
    {
        $user = Auth::user();

        $incomeCategories  = $user->categories()->income()->orderBy('name')->get();
        $expenseCategories = $user->categories()->expense()->orderBy('name')->get();
        $taskPriorities    = $user->taskPriorities()->orderBy('created_at')->get();

        return view('settings', compact('incomeCategories', 'expenseCategories', 'taskPriorities'));
    }

    /**
     * Update the authenticated user's profile information.
     */
    public function updateProfile(Request $request)
    {
        $user = $request->user();

        $validated = $request->validateWithBag('updateProfile', [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
        ]);

        $user->update($validated);

        return back()->with('success', 'Profil berhasil diperbarui!');
    }

    /**
     * Update the authenticated user's password.
     */
    public function updatePassword(Request $request)
    {
        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return back()->with('success', 'Password berhasil diperbarui!');
    }

    /**
     * Store a new category.
     */
    public function storeCategory(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:50',
            'icon' => 'required|string|max:10',
            'type' => 'required|in:income,expense',
        ]);

        Auth::user()->categories()->create($validated);

        return back()->with('success', 'Kategori berhasil dibuat!');
    }

    /**
     * Update an existing category.
     */
    public function updateCategory(Request $request, Category $category)
    {
        // Ensure the user owns this category
        if ($category->user_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:50',
            'icon' => 'required|string|max:10',
        ]);

        $category->update($validated);

        return back()->with('success', 'Kategori berhasil diperbarui!');
    }

    /**
     * Delete a category.
     */
    public function destroyCategory(Category $category)
    {
        // Ensure the user owns this category
        if ($category->user_id !== Auth::id()) {
            abort(403);
        }

        $category->delete();

        return back()->with('success', 'Kategori berhasil dihapus!');
    }

    /**
     * Store a new task priority.
     */
    public function storePriority(Request $request)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:50',
                Rule::unique('task_priorities', 'name')->where(fn ($query) => $query->where('user_id', Auth::id())),
            ],
            'color' => ['required', 'string', 'size:7', 'regex:/^#[0-9A-Fa-f]{6}$/'],
        ]);

        Auth::user()->taskPriorities()->create($validated);

        return back()->with('success', 'Prioritas berhasil dibuat!');
    }

    /**
     * Update an existing task priority.
     */
    public function updatePriority(Request $request, TaskPriority $taskPriority)
    {
        abort_unless($taskPriority->user_id === Auth::id(), 403);

        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:50',
                Rule::unique('task_priorities', 'name')
                    ->ignore($taskPriority->id)
                    ->where(fn ($query) => $query->where('user_id', Auth::id())),
            ],
            'color' => ['required', 'string', 'size:7', 'regex:/^#[0-9A-Fa-f]{6}$/'],
        ]);

        $taskPriority->update($validated);

        return back()->with('success', 'Prioritas berhasil diperbarui!');
    }

    /**
     * Delete an existing task priority.
     */
    public function destroyPriority(TaskPriority $taskPriority)
    {
        abort_unless($taskPriority->user_id === Auth::id(), 403);

        if ($taskPriority->todos()->exists()) {
            return back()->with('error', 'Prioritas masih dipakai oleh tugas aktif dan belum bisa dihapus.');
        }

        if (Auth::user()->taskPriorities()->count() <= 1) {
            return back()->with('error', 'Sisakan minimal satu prioritas agar To-Do List tetap bisa digunakan.');
        }

        $taskPriority->delete();

        return back()->with('success', 'Prioritas berhasil dihapus!');
    }
}
