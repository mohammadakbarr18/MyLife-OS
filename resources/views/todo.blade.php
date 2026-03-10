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
        <button @click="todoModalOpen = true"
                class="inline-flex items-center gap-2 px-5 py-2.5 rounded-2xl text-sm font-semibold
                       bg-[#FCE2CE] text-[#5F402D] border border-[#F5D0B0]
                       hover:bg-[#F5D0B0] hover:shadow-sm transition-all duration-200">
            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
            Add Task
        </button>
    </div>

    @php
        $completedCount = $todos->where('status', 'completed')->count();
        $totalCount = $todos->count();
    @endphp

    {{-- Task List Card --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100/50 overflow-hidden">

        {{-- List Header --}}
        <div class="flex items-center justify-between px-4 sm:px-6 py-3 sm:py-4 border-b border-gray-100">
            <p class="text-sm font-semibold text-gray-500">All Tasks</p>
            <span class="text-xs font-bold text-[#5F402D] bg-[#FCE2CE]/50 px-3 py-1 rounded-full">
                {{ $totalCount }} {{ Str::plural('task', $totalCount) }}
            </span>
        </div>

        @if($todos->isNotEmpty())
            {{-- Task Items --}}
            <div class="divide-y divide-gray-50">
                @foreach($todos as $todo)
                    <div class="flex items-center gap-4 px-4 sm:px-6 py-3 sm:py-4 hover:bg-[#FEF6EF]/50 transition-colors duration-150 group">
                        {{-- Checkbox --}}
                        <input type="checkbox" {{ $todo->status === 'completed' ? 'checked' : '' }} disabled
                               class="w-5 h-5 rounded-lg border-2 border-gray-300 text-[#5F402D]
                                      focus:ring-[#FCE2CE] focus:ring-offset-0 transition-colors flex-shrink-0">

                        {{-- Task Content --}}
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium truncate
                                      {{ $todo->status === 'completed' ? 'text-gray-400 line-through' : 'text-gray-700 group-hover:text-[#3E2723]' }}
                                      transition-colors">
                                {{ $todo->title }}
                            </p>
                            @if($todo->due_date)
                                <p class="text-xs text-gray-400 mt-0.5">
                                    📅 {{ $todo->due_date->format('d M Y') }}
                                </p>
                            @endif
                        </div>

                        {{-- Priority Badge --}}
                        @php
                            $priorityStyles = [
                                'high'   => 'bg-red-50 text-red-600 border-red-200/60',
                                'medium' => 'bg-amber-50 text-amber-700 border-amber-200/60',
                                'low'    => 'bg-blue-50 text-blue-600 border-blue-200/60',
                            ];
                            $pStyle = $priorityStyles[$todo->priority] ?? $priorityStyles['medium'];
                        @endphp
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold border {{ $pStyle }} flex-shrink-0">
                            {{ ucfirst($todo->priority) }}
                        </span>

                        {{-- Status Badge --}}
                        @if($todo->status === 'completed')
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold
                                         bg-emerald-50 text-emerald-700 border border-emerald-200/60 flex-shrink-0">
                                ✅ Done
                            </span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold
                                         bg-orange-50 text-orange-600 border border-orange-200/60 flex-shrink-0">
                                ⏳ Pending
                            </span>
                        @endif
                    </div>
                @endforeach
            </div>

            {{-- Summary Footer --}}
            <div class="px-4 sm:px-6 py-3 sm:py-4 border-t border-gray-100">
                <div class="flex items-center justify-between">
                    <p class="text-xs text-gray-400 font-medium">Completed</p>
                    <p class="text-xs font-bold text-[#5F402D]">{{ $completedCount }} / {{ $totalCount }}</p>
                </div>
                {{-- Progress Bar --}}
                @php $progressPercent = $totalCount > 0 ? round(($completedCount / $totalCount) * 100) : 0; @endphp
                <div class="mt-2 w-full h-1.5 bg-gray-100 rounded-full overflow-hidden">
                    <div class="h-full bg-[#FCE2CE] rounded-full transition-all duration-500"
                         style="width: {{ $progressPercent }}%"></div>
                </div>
            </div>
        @else
            {{-- Empty State --}}
            <div class="flex flex-col items-center justify-center py-20 px-4 sm:px-6">
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
        @endif
    </div>

@endsection
