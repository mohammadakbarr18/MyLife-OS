<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        return back()->with('success', 'Category created successfully!');
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

        return back()->with('success', 'Category updated successfully!');
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

        return back()->with('success', 'Category deleted successfully!');
    }
}
