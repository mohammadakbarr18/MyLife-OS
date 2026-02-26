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
                <button class="inline-flex items-center gap-2 px-5 py-2.5 rounded-2xl text-sm font-semibold
                               bg-emerald-50/90 text-emerald-700 border border-emerald-200
                               hover:bg-emerald-100 hover:shadow-sm transition-all duration-200">
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    Income
                </button>
                <button class="inline-flex items-center gap-2 px-5 py-2.5 rounded-2xl text-sm font-semibold
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
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-blue-50 flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a2.25 2.25 0 0 0-2.25-2.25H15a3 3 0 1 1-6 0H5.25A2.25 2.25 0 0 0 3 12m18 0v6a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 18v-6m18 0V9M3 12V9m18 0a2.25 2.25 0 0 0-2.25-2.25H5.25A2.25 2.25 0 0 0 3 9m18 0V6a2.25 2.25 0 0 0-2.25-2.25H5.25A2.25 2.25 0 0 0 3 6v3" />
                    </svg>
                </div>
                <div class="min-w-0">
                    <p class="text-sm text-gray-400 font-medium">Total Balance</p>
                    <p class="text-xs text-gray-400/80 mb-1">Sisa Saldo</p>
                    <p class="text-3xl font-bold text-gray-800 truncate">Rp 0</p>
                </div>
            </div>
        </div>

        {{-- Card 2: Total Income --}}
        <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100/50
                    hover:shadow-md transition-shadow duration-300">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-emerald-50 flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6 text-emerald-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18 9 11.25l4.306 4.306a11.95 11.95 0 0 1 5.814-5.518l2.74-1.22m0 0-5.94-2.281m5.94 2.28-2.28 5.941" />
                    </svg>
                </div>
                <div class="min-w-0">
                    <p class="text-sm text-gray-400 font-medium">Income This Month</p>
                    <p class="text-xs text-gray-400/80 mb-1">Pemasukan</p>
                    <p class="text-3xl font-bold text-green-600 truncate">Rp 0</p>
                </div>
            </div>
        </div>

        {{-- Card 3: Total Expense --}}
        <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100/50
                    hover:shadow-md transition-shadow duration-300">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-red-50 flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6 text-red-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6 9 12.75l4.286-4.286a11.948 11.948 0 0 1 4.306 6.43l.776 2.898m0 0 3.182-5.511m-3.182 5.51-5.511-3.181" />
                    </svg>
                </div>
                <div class="min-w-0">
                    <p class="text-sm text-gray-400 font-medium">Expense This Month</p>
                    <p class="text-xs text-gray-400/80 mb-1">Pengeluaran</p>
                    <p class="text-3xl font-bold text-red-600 truncate">Rp 0</p>
                </div>
            </div>
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
                        {{-- Row 1 --}}
                        <tr class="hover:bg-[#FEF6EF]/50 transition-colors duration-150">
                            <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">16 Feb</td>
                            <td class="px-6 py-4">
                                <p class="text-sm font-medium text-gray-700">Makan Siang</p>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold
                                             bg-amber-50 text-amber-700 border border-amber-200/60">
                                    🍔 Food
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm font-semibold text-red-500 text-right whitespace-nowrap">
                                -Rp 25.000
                            </td>
                        </tr>
                        {{-- Row 2 --}}
                        <tr class="hover:bg-[#FEF6EF]/50 transition-colors duration-150">
                            <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">15 Feb</td>
                            <td class="px-6 py-4">
                                <p class="text-sm font-medium text-gray-700">Gaji Bulanan</p>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold
                                             bg-emerald-50 text-emerald-700 border border-emerald-200/60">
                                    💰 Salary
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm font-semibold text-green-600 text-right whitespace-nowrap">
                                +Rp 5.000.000
                            </td>
                        </tr>
                        {{-- Row 3 --}}
                        <tr class="hover:bg-[#FEF6EF]/50 transition-colors duration-150">
                            <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">14 Feb</td>
                            <td class="px-6 py-4">
                                <p class="text-sm font-medium text-gray-700">Bensin Motor</p>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold
                                             bg-blue-50 text-blue-700 border border-blue-200/60">
                                    🚗 Transport
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm font-semibold text-red-500 text-right whitespace-nowrap">
                                -Rp 30.000
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            {{-- Empty state hint (hidden when data exists) --}}
            {{-- 
            <div class="px-6 py-12 text-center">
                <p class="text-sm text-gray-400">No transactions yet. Start tracking your finances!</p>
            </div>
            --}}
        </div>

        {{-- Widget B: Today's Tasks (1 column) --}}
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

                {{-- Task Item: Incomplete --}}
                <label class="flex items-center gap-3 px-3 py-3 rounded-xl cursor-pointer
                              hover:bg-[#FEF6EF]/70 transition-colors duration-150 group">
                    <input type="checkbox" disabled
                           class="w-5 h-5 rounded-lg border-2 border-gray-300 text-[#5F402D]
                                  focus:ring-[#FCE2CE] focus:ring-offset-0 transition-colors flex-shrink-0">
                    <span class="text-sm font-medium text-gray-700 group-hover:text-[#3E2723] transition-colors">
                        Selesaikan Tugas Laravel
                    </span>
                </label>

                {{-- Task Item: Completed --}}
                <label class="flex items-center gap-3 px-3 py-3 rounded-xl cursor-pointer
                              hover:bg-[#FEF6EF]/70 transition-colors duration-150 group">
                    <input type="checkbox" checked disabled
                           class="w-5 h-5 rounded-lg border-2 border-gray-300 text-[#5F402D]
                                  focus:ring-[#FCE2CE] focus:ring-offset-0 transition-colors flex-shrink-0">
                    <span class="text-sm font-medium text-gray-400 line-through">
                        Meeting dengan Klien
                    </span>
                </label>

                {{-- Task Item: Incomplete --}}
                <label class="flex items-center gap-3 px-3 py-3 rounded-xl cursor-pointer
                              hover:bg-[#FEF6EF]/70 transition-colors duration-150 group">
                    <input type="checkbox" disabled
                           class="w-5 h-5 rounded-lg border-2 border-gray-300 text-[#5F402D]
                                  focus:ring-[#FCE2CE] focus:ring-offset-0 transition-colors flex-shrink-0">
                    <span class="text-sm font-medium text-gray-700 group-hover:text-[#3E2723] transition-colors">
                        Olahraga Sore
                    </span>
                </label>

            </div>

            {{-- Task Summary Footer --}}
            <div class="px-6 py-4 border-t border-gray-100">
                <div class="flex items-center justify-between">
                    <p class="text-xs text-gray-400 font-medium">Completed</p>
                    <p class="text-xs font-bold text-[#5F402D]">1 / 3</p>
                </div>
                {{-- Progress Bar --}}
                <div class="mt-2 w-full h-1.5 bg-gray-100 rounded-full overflow-hidden">
                    <div class="h-full bg-[#FCE2CE] rounded-full transition-all duration-500"
                         style="width: 33%"></div>
                </div>
            </div>
        </div>

    </div>

@endsection
