@extends('layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Welcome back, ' . (Auth::user()->name ?? 'User') . '!')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
        <!-- Quick Stats Card -->
        <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100/50">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-[#FCE2CE] flex items-center justify-center">
                    <svg class="w-6 h-6 text-[#5F402D]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-400 font-medium">To-Do Tasks</p>
                    <p class="text-2xl font-bold text-[#3E2723]">0</p>
                </div>
            </div>
        </div>

        <!-- Transactions Card -->
        <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100/50">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-[#E8F5E9] flex items-center justify-center">
                    <svg class="w-6 h-6 text-[#2E7D32]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-400 font-medium">Transactions</p>
                    <p class="text-2xl font-bold text-[#3E2723]">0</p>
                </div>
            </div>
        </div>

        <!-- Welcome Card -->
        <div class="bg-gradient-to-br from-[#FCE2CE] to-[#FEF6EF] rounded-3xl p-6 shadow-sm md:col-span-2 xl:col-span-1">
            <h3 class="text-lg font-bold text-[#3E2723] mb-2" style="font-family: 'Poppins', sans-serif;">
                Hello, {{ Auth::user()->name ?? 'User' }}! 👋
            </h3>
            <p class="text-sm text-[#5F402D]/70 leading-relaxed">
                Your personal life dashboard is ready. Start organizing your tasks and tracking your finances.
            </p>
        </div>
    </div>
@endsection
