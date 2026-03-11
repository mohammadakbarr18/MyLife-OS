@extends('layouts.app')

@section('title', 'To-Do List')
@section('page-title', 'To-Do List')
@section('page-subtitle', 'Organize your tasks & goals')

@section('content')

    {{-- Success Flash Message --}}
    @if(session('success'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
             x-transition:leave="transition ease-in duration-300"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-2"
             class="mb-6 px-5 py-3.5 rounded-2xl bg-emerald-50 border border-emerald-100 text-emerald-700 text-sm font-semibold flex items-center gap-3 shadow-sm">
            <svg class="w-5 h-5 text-emerald-500 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            {{ session('success') }}
        </div>
    @endif

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
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100/50"
         x-data="{ completedCount: {{ $completedCount }}, totalCount: {{ $totalCount }} }">

        {{-- List Header --}}
        <div class="flex items-center justify-between px-4 sm:px-6 py-3 sm:py-4 border-b border-gray-100">
            <p class="text-sm font-semibold text-gray-500">All Tasks</p>
            <span class="text-xs font-bold text-[#5F402D] bg-[#FCE2CE]/50 px-3 py-1 rounded-full"
                  x-text="totalCount + ' ' + (totalCount === 1 ? 'task' : 'tasks')">
                {{ $totalCount }} {{ Str::plural('task', $totalCount) }}
            </span>
        </div>

        @if($todos->isNotEmpty())
            {{-- Task Items --}}
            <div class="divide-y divide-gray-50">
                @foreach($todos as $todo)
                    @php
                        $priorityStyles = [
                            'high'   => 'bg-red-50 text-red-600 border-red-200/60',
                            'medium' => 'bg-amber-50 text-amber-700 border-amber-200/60',
                            'low'    => 'bg-blue-50 text-blue-600 border-blue-200/60',
                        ];
                        $pStyle = $priorityStyles[$todo->priority] ?? $priorityStyles['medium'];
                    @endphp

                    {{-- Task Row: Mobile = single horizontal row, Desktop = row with hover animation --}}
                    <div class="group relative flex flex-row items-center justify-between p-4 px-4 md:px-6
                                hover:bg-[#FEF6EF]/50 transition-colors duration-150 gap-2 md:gap-0"
                         x-data="{ completed: {{ $todo->status === 'completed' ? 'true' : 'false' }} }">

                        {{-- Left: Checkbox & Title+Date --}}
                        <div class="flex items-start gap-3 flex-1 min-w-0">
                            {{-- Checkbox --}}
                            <input type="checkbox" :checked="completed"
                                   @click="fetch('{{ route('todo.toggle', $todo->id) }}', {
                                       method: 'PATCH',
                                       headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' }
                                   }).then(r => r.json()).then(data => {
                                       let was = completed;
                                       completed = data.is_completed;
                                       if (!was && completed) completedCount++;
                                       if (was && !completed) completedCount--;
                                   })"
                                   class="w-5 h-5 mt-0.5 rounded-lg border-2 border-gray-300 text-[#5F402D]
                                          focus:ring-[#FCE2CE] focus:ring-offset-0 cursor-pointer flex-shrink-0">

                            {{-- Title + Date Stack --}}
                            <div class="flex flex-col min-w-0">
                                <p class="text-sm font-medium truncate"
                                   :class="completed ? 'text-gray-400 line-through' : 'text-gray-700 group-hover:text-[#3E2723]'">
                                    {{ $todo->title }}
                                </p>
                                @if($todo->due_date)
                                    <p class="text-xs text-gray-400 mt-0.5">
                                        📅 {{ $todo->due_date->format('d M Y') }}
                                    </p>
                                @endif
                            </div>
                        </div>

                        {{-- Right: Badges + Action Buttons wrapper --}}
                        <div class="flex items-center gap-3 flex-shrink-0">

                            {{-- Badges (slides left on desktop hover) --}}
                            <div class="flex items-center gap-2
                                        md:transition-transform md:duration-300 md:ease-out
                                        md:group-hover:-translate-x-[5.5rem]">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold border {{ $pStyle }}">
                                    {{ ucfirst($todo->priority) }}
                                </span>
                                <span x-show="completed"
                                      class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold
                                             bg-emerald-50 text-emerald-700 border border-emerald-200/60">
                                    ✅ Done
                                </span>
                                <span x-show="!completed"
                                      class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold
                                             bg-orange-50 text-orange-600 border border-orange-200/60">
                                    ⏳ Pending
                                </span>
                            </div>

                            {{-- Action Buttons --}}
                            {{-- Mobile: always visible inline | Desktop: absolute, slides in on hover --}}
                            <div class="flex items-center gap-1
                                        md:absolute md:right-4 md:top-1/2 md:-translate-y-1/2 md:z-10
                                        md:opacity-0 md:translate-x-4 md:pointer-events-none
                                        md:group-hover:opacity-100 md:group-hover:translate-x-0 md:group-hover:pointer-events-auto
                                        md:transition-all md:duration-300 md:ease-out">
                                {{-- Edit --}}
                                <button type="button"
                                        @click="editTodoModalOpen = true; editTodoId = {{ $todo->id }}; editTodoTitle = '{{ addslashes($todo->title) }}'; editTodoPriority = '{{ $todo->priority }}'; editTodoDueDate = '{{ $todo->due_date ? $todo->due_date->format('Y-m-d') : '' }}'"
                                        class="p-2 rounded-xl text-gray-400 hover:text-amber-600 hover:bg-amber-50 transition-colors duration-200"
                                        title="Edit">
                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                    </svg>
                                </button>
                                {{-- Delete --}}
                                <button type="button"
                                        @click.prevent="deleteModalOpen = true; taskToDeleteUrl = '{{ route('todo.destroy', $todo->id) }}'"
                                        class="p-2 rounded-xl text-gray-400 hover:text-red-500 hover:bg-red-50 transition-colors duration-200"
                                        title="Delete">
                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Summary Footer (reactive) --}}
            <div class="px-4 sm:px-6 py-3 sm:py-4 border-t border-gray-100">
                <div class="flex items-center justify-between">
                    <p class="text-xs text-gray-400 font-medium">Completed</p>
                    <p class="text-xs font-bold text-[#5F402D]" x-text="completedCount + ' / ' + totalCount"></p>
                </div>
                {{-- Progress Bar --}}
                <div class="mt-2 w-full h-1.5 bg-gray-100 rounded-full overflow-hidden">
                    <div class="h-full bg-[#FCE2CE] rounded-full transition-all duration-500"
                         :style="'width: ' + (totalCount > 0 ? Math.round((completedCount / totalCount) * 100) : 0) + '%'"></div>
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
