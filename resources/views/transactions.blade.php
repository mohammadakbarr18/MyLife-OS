@extends('layouts.app')

@section('title', 'Transactions')
@section('page-title', 'Transactions')
@section('page-subtitle', 'Manage your income & expenses')

@section('content')

    {{-- Page Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
        <div>
            <h2 class="text-lg font-bold text-[#3E2723]" style="font-family: 'Poppins', sans-serif;">
                Transactions History
            </h2>
            <p class="text-sm text-gray-400 mt-0.5">Track all your income and expenses</p>
        </div>

        {{-- Action Buttons --}}
        <div class="flex items-center gap-3">
            <button @click="transactionModalOpen = true; transactionType = 'income'"
                    class="inline-flex items-center gap-2 px-5 py-2.5 rounded-2xl text-sm font-semibold
                           bg-emerald-50 text-emerald-700 border border-emerald-200
                           hover:bg-emerald-100 hover:shadow-sm transition-all duration-200">
                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                Income
            </button>
            <button @click="transactionModalOpen = true; transactionType = 'expense'"
                    class="inline-flex items-center gap-2 px-5 py-2.5 rounded-2xl text-sm font-semibold
                           bg-red-50 text-red-600 border border-red-200
                           hover:bg-red-100 hover:shadow-sm transition-all duration-200">
                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                Expense
            </button>
        </div>
    </div>

    {{-- Transactions Table --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100/50 overflow-hidden">

        @if($transactions->isNotEmpty())
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="text-left border-b border-gray-100">
                            <th class="px-6 py-4 text-xs font-semibold text-gray-400 uppercase tracking-wider">Date</th>
                            <th class="px-6 py-4 text-xs font-semibold text-gray-400 uppercase tracking-wider">Description</th>
                            <th class="px-6 py-4 text-xs font-semibold text-gray-400 uppercase tracking-wider">Category</th>
                            <th class="px-6 py-4 text-xs font-semibold text-gray-400 uppercase tracking-wider">Type</th>
                            <th class="px-6 py-4 text-xs font-semibold text-gray-400 uppercase tracking-wider text-right">Amount</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @foreach($transactions as $transaction)
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
                                    {{ $transaction->date->format('d M Y') }}
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
                                <td class="px-6 py-4">
                                    @if($transaction->type === 'income')
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold
                                                     bg-green-50 text-green-700 border border-green-200/60">
                                            ↗ Income
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold
                                                     bg-red-50 text-red-600 border border-red-200/60">
                                            ↘ Expense
                                        </span>
                                    @endif
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
            {{-- Empty State --}}
            <div class="flex flex-col items-center justify-center py-20 px-6">
                {{-- Icon --}}
                <div class="w-20 h-20 rounded-3xl bg-[#FCE2CE]/50 flex items-center justify-center mb-6">
                    <svg class="w-10 h-10 text-[#5F402D]/40" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" />
                    </svg>
                </div>

                {{-- Text --}}
                <h3 class="text-lg font-bold text-[#3E2723] mb-2" style="font-family: 'Poppins', sans-serif;">
                    No Transactions Yet
                </h3>
                <p class="text-sm text-gray-400 text-center max-w-sm leading-relaxed">
                    Start tracking your finances by adding your first income or expense transaction.
                </p>

                {{-- Decorative dots --}}
                <div class="flex items-center gap-1.5 mt-8">
                    <div class="w-2 h-2 rounded-full bg-[#FCE2CE]"></div>
                    <div class="w-2 h-2 rounded-full bg-[#FCE2CE]/60"></div>
                    <div class="w-2 h-2 rounded-full bg-[#FCE2CE]/30"></div>
                </div>
            </div>
        @endif
    </div>

@endsection
