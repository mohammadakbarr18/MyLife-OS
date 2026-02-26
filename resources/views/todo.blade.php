@extends('layouts.app')

@section('title', 'To-Do List')
@section('page-title', 'To-Do List')
@section('page-subtitle', 'Organize your tasks & goals')

@section('content')

    {{-- Page Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
        <div>
            <h2 class="text-lg font-bold text-[#3E2723]" style="font-family: 'Poppins', sans-serif;">
                My To-Do List
            </h2>
            <p class="text-sm text-gray-400 mt-0.5">Stay productive and organized</p>
        </div>

        {{-- Add Task Button --}}
        <button class="inline-flex items-center gap-2 px-5 py-2.5 rounded-2xl text-sm font-semibold
                       bg-[#FCE2CE] text-[#5F402D] border border-[#F5D0B0]
                       hover:bg-[#F5D0B0] hover:shadow-sm transition-all duration-200">
            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
            Add Task
        </button>
    </div>

    {{-- Placeholder Task List --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100/50 overflow-hidden">

        {{-- List Header --}}
        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
            <p class="text-sm font-semibold text-gray-500">Today's Tasks</p>
            <span class="text-xs font-bold text-[#5F402D] bg-[#FCE2CE]/50 px-3 py-1 rounded-full">0 tasks</span>
        </div>

        {{-- Empty State --}}
        <div class="flex flex-col items-center justify-center py-20 px-6">
            {{-- Icon --}}
            <div class="w-20 h-20 rounded-3xl bg-[#FCE2CE]/50 flex items-center justify-center mb-6">
                <svg class="w-10 h-10 text-[#5F402D]/40" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
            </div>

            {{-- Text --}}
            <h3 class="text-lg font-bold text-[#3E2723] mb-2" style="font-family: 'Poppins', sans-serif;">
                No Tasks Yet
            </h3>
            <p class="text-sm text-gray-400 text-center max-w-sm leading-relaxed">
                Start adding tasks to stay organized and productive. Your to-do list will appear here.
            </p>

            {{-- Decorative dots --}}
            <div class="flex items-center gap-1.5 mt-8">
                <div class="w-2 h-2 rounded-full bg-[#FCE2CE]"></div>
                <div class="w-2 h-2 rounded-full bg-[#FCE2CE]/60"></div>
                <div class="w-2 h-2 rounded-full bg-[#FCE2CE]/30"></div>
            </div>
        </div>
    </div>

@endsection
