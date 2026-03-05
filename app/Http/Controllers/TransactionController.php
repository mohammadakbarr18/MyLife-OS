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
     * Display transaction summary grouped by year and month.
     */
    public function summary()
    {
        $transactions = Auth::user()
            ->transactions()
            ->orderBy('date', 'desc')
            ->get();

        // Group by Year -> Month
        $groupedTransactions = [];

        foreach ($transactions as $transaction) {
            $year  = $transaction->date->format('Y');
            $month = $transaction->date->format('m'); // numeric month for sorting

            if (!isset($groupedTransactions[$year])) {
                $groupedTransactions[$year] = [
                    'year'          => $year,
                    'total_income'  => 0,
                    'total_expense' => 0,
                    'months'        => [],
                ];
            }

            if (!isset($groupedTransactions[$year]['months'][$month])) {
                $groupedTransactions[$year]['months'][$month] = [
                    'month_name'    => $transaction->date->translatedFormat('F'),
                    'month_number'  => $month,
                    'year'          => $year,
                    'total_income'  => 0,
                    'total_expense' => 0,
                ];
            }

            $amount = (float) $transaction->amount;

            if ($transaction->type === 'income') {
                $groupedTransactions[$year]['total_income']                  += $amount;
                $groupedTransactions[$year]['months'][$month]['total_income'] += $amount;
            } else {
                $groupedTransactions[$year]['total_expense']                  += $amount;
                $groupedTransactions[$year]['months'][$month]['total_expense'] += $amount;
            }
        }

        // Sort years descending, months descending within each year
        krsort($groupedTransactions);
        foreach ($groupedTransactions as &$yearData) {
            krsort($yearData['months']);
        }

        return view('transactions-summary', compact('groupedTransactions'));
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
