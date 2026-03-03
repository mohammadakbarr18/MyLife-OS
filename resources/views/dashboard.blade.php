@extends('layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Welcome back, ' . (Auth::user()->name ?? 'User') . '!')

@section('content')

    {{-- ============================================================== --}}
    {{-- SECTION 1: FINANCIAL OVERVIEW                                  --}}
    {{-- ============================================================== --}}

    {{-- Section Header: Financial Overview --}}
    <div class="mb-6">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="text-lg font-bold text-[#3E2723]" style="font-family: 'Poppins', sans-serif;">
                    📊 Financial Overview
                </h2>
                <p class="text-sm text-gray-400 mt-0.5">Your monthly summary at a glance</p>
            </div>

            {{-- Quick Action Buttons --}}
            <div class="relative z-10 flex items-center gap-3">
                <button @click="transactionModalOpen = true; transactionType = 'income'"
                        class="inline-flex items-center gap-2 px-5 py-2.5 rounded-2xl text-sm font-semibold
                               bg-emerald-50/90 text-emerald-700 border border-emerald-200
                               hover:bg-emerald-100 hover:shadow-sm transition-all duration-200">
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    Income
                </button>
                <button @click="transactionModalOpen = true; transactionType = 'expense'"
                        class="inline-flex items-center gap-2 px-5 py-2.5 rounded-2xl text-sm font-semibold
                               bg-red-50/90 text-red-600 border border-red-200
                               hover:bg-red-100 hover:shadow-sm transition-all duration-200">
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    Expense
                </button>
            </div>
        </div>
    </div>

    {{-- Financial Stats Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        {{-- Card 1: Current Balance --}}
        <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100/50
                    hover:shadow-md transition-shadow duration-300">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-10 h-10 rounded-xl bg-blue-50 flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a2.25 2.25 0 0 0-2.25-2.25H15a3 3 0 1 1-6 0H5.25A2.25 2.25 0 0 0 3 12m18 0v6a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 18v-6m18 0V9M3 12V9m18 0a2.25 2.25 0 0 0-2.25-2.25H5.25A2.25 2.25 0 0 0 3 9m18 0V6a2.25 2.25 0 0 0-2.25-2.25H5.25A2.25 2.25 0 0 0 3 6v3" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500 font-medium leading-tight">Total Balance</p>
                    <p class="text-xs text-gray-400">Sisa Saldo</p>
                </div>
            </div>
            <p class="text-2xl font-extrabold whitespace-nowrap {{ $totalBalance >= 0 ? 'text-gray-800' : 'text-red-600' }}">
                Rp {{ $formattedBalance }}
            </p>
        </div>

        {{-- Card 2: Total Income --}}
        <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100/50
                    hover:shadow-md transition-shadow duration-300">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-10 h-10 rounded-xl bg-emerald-50 flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-emerald-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18 9 11.25l4.306 4.306a11.95 11.95 0 0 1 5.814-5.518l2.74-1.22m0 0-5.94-2.281m5.94 2.28-2.28 5.941" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500 font-medium leading-tight">Income This Month</p>
                    <p class="text-xs text-gray-400">Pemasukan</p>
                </div>
            </div>
            <p class="text-2xl font-extrabold text-emerald-600 whitespace-nowrap">
                Rp {{ $formattedIncome }}
            </p>
        </div>

        {{-- Card 3: Total Expense --}}
        <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100/50
                    hover:shadow-md transition-shadow duration-300">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-10 h-10 rounded-xl bg-red-50 flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-red-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6 9 12.75l4.286-4.286a11.948 11.948 0 0 1 4.306 6.43l.776 2.898m0 0 3.182-5.511m-3.182 5.51-5.511-3.181" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500 font-medium leading-tight">Expense This Month</p>
                    <p class="text-xs text-gray-400">Pengeluaran</p>
                </div>
            </div>
            <p class="text-2xl font-extrabold text-red-600 whitespace-nowrap">
                Rp {{ $formattedExpense }}
            </p>
        </div>

    </div>

    {{-- ============================================================== --}}
    {{-- SECTION 2: DASHBOARD WIDGETS                                   --}}
    {{-- ============================================================== --}}

    {{-- Section Header: Dashboard Activity --}}
    <div class="mt-12 mb-6">
        <h2 class="text-lg font-bold text-[#3E2723]" style="font-family: 'Poppins', sans-serif;">
            📋 Dashboard Activity
        </h2>
        <p class="text-sm text-gray-400 mt-0.5">Recent transactions and today's tasks</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- Widget A: Recent Transactions (2 columns) --}}
        <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-gray-100/50 overflow-hidden">
            {{-- Widget Header --}}
            <div class="flex items-center justify-between px-6 py-5 border-b border-gray-100">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-xl bg-[#FCE2CE] flex items-center justify-center">
                        <svg class="w-4.5 h-4.5 text-[#5F402D]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 21 3 16.5m0 0L7.5 12M3 16.5h13.5m0-13.5L21 7.5m0 0L16.5 12M21 7.5H7.5" />
                        </svg>
                    </div>
                    <h3 class="text-base font-bold text-[#3E2723]" style="font-family: 'Poppins', sans-serif;">
                        Recent Activity
                    </h3>
                </div>
                <a href="{{ route('transactions') }}"
                   class="text-sm font-semibold text-[#5F402D] hover:text-[#3E2723] transition-colors flex items-center gap-1">
                    View All
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                    </svg>
                </a>
            </div>

            {{-- Table --}}
            @if($recentTransactions->isNotEmpty())
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="text-left">
                                <th class="px-6 py-3.5 text-xs font-semibold text-gray-400 uppercase tracking-wider">Date</th>
                                <th class="px-6 py-3.5 text-xs font-semibold text-gray-400 uppercase tracking-wider">Description</th>
                                <th class="px-6 py-3.5 text-xs font-semibold text-gray-400 uppercase tracking-wider">Category</th>
                                <th class="px-6 py-3.5 text-xs font-semibold text-gray-400 uppercase tracking-wider text-right">Amount</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @foreach($recentTransactions as $transaction)
                                @php
                                    $categoryStyles = [
                                        'Salary'        => ['bg' => 'bg-emerald-50', 'text' => 'text-emerald-700', 'border' => 'border-emerald-200/60', 'emoji' => '💰'],
                                        'Freelance'     => ['bg' => 'bg-purple-50', 'text' => 'text-purple-700', 'border' => 'border-purple-200/60', 'emoji' => '💻'],
                                        'Bonus'         => ['bg' => 'bg-yellow-50', 'text' => 'text-yellow-700', 'border' => 'border-yellow-200/60', 'emoji' => '🎉'],
                                        'Food'          => ['bg' => 'bg-amber-50', 'text' => 'text-amber-700', 'border' => 'border-amber-200/60', 'emoji' => '🍔'],
                                        'Transport'     => ['bg' => 'bg-blue-50', 'text' => 'text-blue-700', 'border' => 'border-blue-200/60', 'emoji' => '🚗'],
                                        'Bills'         => ['bg' => 'bg-rose-50', 'text' => 'text-rose-700', 'border' => 'border-rose-200/60', 'emoji' => '📄'],
                                        'Entertainment' => ['bg' => 'bg-pink-50', 'text' => 'text-pink-700', 'border' => 'border-pink-200/60', 'emoji' => '🎮'],
                                        'Shopping'      => ['bg' => 'bg-indigo-50', 'text' => 'text-indigo-700', 'border' => 'border-indigo-200/60', 'emoji' => '🛍️'],
                                    ];
                                    $style = $categoryStyles[$transaction->category] ?? ['bg' => 'bg-gray-50', 'text' => 'text-gray-700', 'border' => 'border-gray-200/60', 'emoji' => '📌'];
                                @endphp
                                <tr class="hover:bg-[#FEF6EF]/50 transition-colors duration-150">
                                    <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                        {{ $transaction->date->format('d M') }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <p class="text-sm font-medium text-gray-700">{{ $transaction->description }}</p>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold
                                                     {{ $style['bg'] }} {{ $style['text'] }} border {{ $style['border'] }}">
                                            {{ $style['emoji'] }} {{ $transaction->category }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-sm font-semibold text-right whitespace-nowrap
                                               {{ $transaction->type === 'income' ? 'text-green-600' : 'text-red-500' }}">
                                        {{ $transaction->type === 'income' ? '+' : '-' }}Rp {{ number_format($transaction->amount, 0, ',', '.') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                {{-- Empty state --}}
                <div class="px-6 py-12 text-center">
                    <p class="text-sm text-gray-400">No transactions yet. Start tracking your finances!</p>
                </div>
            @endif
        </div>

        {{-- Widget B: Today's Tasks (1 column) --}}
        @php
            $completedCount = $todayTodos->where('status', 'completed')->count();
            $totalTodoCount = $todayTodos->count();
            $progressPercent = $totalTodoCount > 0 ? round(($completedCount / $totalTodoCount) * 100) : 0;
        @endphp
        <div class="lg:col-span-1 bg-white rounded-2xl shadow-sm border border-gray-100/50 overflow-hidden">
            {{-- Widget Header --}}
            <div class="flex items-center justify-between px-6 py-5 border-b border-gray-100">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-xl bg-[#FCE2CE] flex items-center justify-center">
                        <svg class="w-4.5 h-4.5 text-[#5F402D]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                    </div>
                    <h3 class="text-base font-bold text-[#3E2723]" style="font-family: 'Poppins', sans-serif;">
                        Today's Tasks
                    </h3>
                </div>
                <a href="{{ route('todo') }}"
                   class="text-sm font-semibold text-[#5F402D] hover:text-[#3E2723] transition-colors flex items-center gap-1">
                    All
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                    </svg>
                </a>
            </div>

            {{-- Task List --}}
            <div class="px-6 py-4 space-y-1">
                @forelse($todayTodos as $todo)
                    <label class="flex items-center gap-3 px-3 py-3 rounded-xl cursor-pointer
                                  hover:bg-[#FEF6EF]/70 transition-colors duration-150 group">
                        <input type="checkbox" {{ $todo->status === 'completed' ? 'checked' : '' }} disabled
                               class="w-5 h-5 rounded-lg border-2 border-gray-300 text-[#5F402D]
                                      focus:ring-[#FCE2CE] focus:ring-offset-0 transition-colors flex-shrink-0">
                        <span class="text-sm font-medium {{ $todo->status === 'completed' ? 'text-gray-400 line-through' : 'text-gray-700 group-hover:text-[#3E2723]' }} transition-colors">
                            {{ $todo->title }}
                        </span>
                    </label>
                @empty
                    <div class="py-8 text-center">
                        <p class="text-sm text-gray-400">No tasks yet. Add one to get started!</p>
                    </div>
                @endforelse
            </div>

            {{-- Task Summary Footer --}}
            <div class="px-6 py-4 border-t border-gray-100">
                <div class="flex items-center justify-between">
                    <p class="text-xs text-gray-400 font-medium">Completed</p>
                    <p class="text-xs font-bold text-[#5F402D]">{{ $completedCount }} / {{ $totalTodoCount }}</p>
                </div>
                {{-- Progress Bar --}}
                <div class="mt-2 w-full h-1.5 bg-gray-100 rounded-full overflow-hidden">
                    <div class="h-full bg-[#FCE2CE] rounded-full transition-all duration-500"
                         style="width: {{ $progressPercent }}%"></div>
                </div>
            </div>
        </div>

    </div>

@endsection
