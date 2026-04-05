<?php

namespace App\Http\Controllers;

use App\Models\Category;
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

        return view('settings', compact('incomeCategories', 'expenseCategories'));
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
}
