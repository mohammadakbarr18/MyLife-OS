<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display the dashboard with financial summary and recent activity.
     */
    public function index()
    {
        $user = Auth::user();

        // ── Financial Summary ────────────────────────────────


        // Current month only
        $incomeThisMonth = $user->transactions()
            ->where('type', 'income')
            ->whereMonth('date', now()->month)
            ->whereYear('date', now()->year)
            ->sum('amount');

        $expenseThisMonth = $user->transactions()
            ->where('type', 'expense')
            ->whereMonth('date', now()->month)
            ->whereYear('date', now()->year)
            ->sum('amount');

        // ── Format for display ────────────────────────────────
        $formattedIncome  = $this->formatRupiahShorthand($incomeThisMonth);
        $formattedExpense = $this->formatRupiahShorthand($expenseThisMonth);

        // ── Recent Transactions (latest 5) ───────────────────
        $recentTransactions = $user->transactions()
            ->with('category')
            ->orderBy('date', 'desc')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // ── Today's Todos ────────────────────────────────────
        $todayTodos = $user->todos()
            ->orderByRaw("CASE WHEN status = 'pending' THEN 0 ELSE 1 END")
            ->orderBy('created_at', 'desc')
            ->get();

        // ── Today's Schedules ────────────────────────────────
        $todaySchedules = $user->schedules()
            ->whereDate('date', Carbon::today())
            ->ordered()
            ->get();

        return view('dashboard', compact(
            'incomeThisMonth',
            'expenseThisMonth',
            'formattedIncome',
            'formattedExpense',
            'recentTransactions',
            'todayTodos',
            'todaySchedules',
        ));
    }

    /**
     * Format a numeric amount into Indonesian Rupiah shorthand.
     *
     * Examples:
     *   500000      → "500.000"
     *   6924000     → "6,92 Juta"
     *   1500000000  → "1,5 Miliar"
     */
    private function formatRupiahShorthand(float|int $amount): string
    {
        $isNegative = $amount < 0;
        $abs = abs($amount);

        if ($abs >= 1_000_000_000) {
            $value = $abs / 1_000_000_000;
            $formatted = rtrim(rtrim(number_format($value, 2, ',', '.'), '0'), ',');
            $suffix = ' Miliar';
        } elseif ($abs >= 1_000_000) {
            $value = $abs / 1_000_000;
            $formatted = rtrim(rtrim(number_format($value, 2, ',', '.'), '0'), ',');
            $suffix = ' Juta';
        } else {
            $formatted = number_format($abs, 0, ',', '.');
            $suffix = '';
        }

        return ($isNegative ? '-' : '') . $formatted . $suffix;
    }
}
