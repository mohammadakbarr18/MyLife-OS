<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    /**
     * Display all transactions for the authenticated user.
     */
    public function index()
    {
        $transactions = Auth::user()
            ->transactions()
            ->with('category')
            ->orderBy('date', 'desc')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('transactions', compact('transactions'));
    }

    /**
     * Store a new transaction.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'type'        => 'required|in:income,expense',
            'amount'      => 'required|numeric|min:1',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'date'        => 'required|date',
        ]);

        Auth::user()->transactions()->create($validated);

        return back()->with('success', 'Transaction added!');
    }
}
