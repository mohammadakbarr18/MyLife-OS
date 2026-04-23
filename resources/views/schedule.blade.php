@extends('layouts.app')

@section('title', 'Jadwal')
@section('page-title', 'Jadwal')
@section('page-subtitle', 'Atur jadwal dan rutinitas harianmu')

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

    {{-- ================================================================ --}}
    {{-- DATE NAVIGATION RIBBON --}}
    {{-- ================================================================ --}}
    <div class="mb-8" x-data="{ showDatePicker: false }">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100/60 px-3 py-2.5 sm:px-5 sm:py-3 flex items-center justify-between gap-2">

            {{-- Previous Day --}}
            <a href="{{ route('schedule.index', ['date' => $prevDate]) }}"
               class="flex items-center gap-1.5 px-3 py-2 sm:px-4 sm:py-2.5 rounded-xl text-sm font-semibold
                      text-gray-500 hover:text-[#5F402D] hover:bg-[#FCE2CE]/40 transition-all duration-200 group">
                <svg class="w-4 h-4 group-hover:-translate-x-0.5 transition-transform" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                </svg>
                <span class="hidden sm:inline">Kemarin</span>
            </a>

            {{-- Center: Date Display + Calendar Jump --}}
            <div class="flex-1 flex items-center justify-center gap-2 sm:gap-3 relative">
                {{-- Date Text --}}
                <div class="text-center">
                    @php
                        $parsedDate = \Carbon\Carbon::parse($selectedDate);
                    @endphp
                    @if($isToday)
                        <div class="flex items-center justify-center gap-2">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider
                                         bg-[#5F402D] text-white">Hari Ini</span>
                            <span class="text-sm sm:text-base font-bold text-[#3E2723]" style="font-family: 'Poppins', sans-serif;">
                                {{ $parsedDate->translatedFormat('l, d F Y') }}
                            </span>
                        </div>
                    @else
                        <span class="text-sm sm:text-base font-bold text-[#3E2723]" style="font-family: 'Poppins', sans-serif;">
                            {{ $parsedDate->translatedFormat('l, d F Y') }}
                        </span>
                    @endif
                </div>

                {{-- Calendar Jump Button --}}
                <div class="relative">
                    <button @click="showDatePicker = !showDatePicker" type="button"
                            class="p-2 rounded-xl text-gray-400 hover:text-[#5F402D] hover:bg-[#FCE2CE]/40 transition-all duration-200"
                            title="Pilih Tanggal">
                        <svg class="w-4.5 h-4.5 sm:w-5 sm:h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                        </svg>
                    </button>

                    {{-- Native date picker dropdown --}}
                    <div x-show="showDatePicker" x-cloak @click.away="showDatePicker = false"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 scale-95 -translate-y-1"
                         x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                         x-transition:leave-end="opacity-0 scale-95 -translate-y-1"
                         class="absolute top-full right-0 mt-2 z-50 bg-white rounded-2xl shadow-xl border border-gray-100 p-4 min-w-[250px]">
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2 ml-1">Pilih Tanggal</label>
                        <input type="date" value="{{ $selectedDate }}"
                               @change="window.location.href = '{{ route('schedule.index') }}?date=' + $event.target.value"
                               class="block w-full rounded-xl bg-gray-50 border border-gray-200/80 py-2.5 px-4 text-gray-900 text-sm font-semibold focus:bg-white focus:ring-4 focus:ring-[#FCE2CE]/50 focus:border-[#FCE2CE] transition-all cursor-pointer">
                        @unless($isToday)
                            <a href="{{ route('schedule.index') }}"
                               class="mt-2.5 block w-full text-center text-xs font-bold text-[#5F402D] hover:text-[#3E2723] py-2 rounded-xl hover:bg-[#FCE2CE]/30 transition-colors duration-200">
                                ← Kembali ke Hari Ini
                            </a>
                        @endunless
                    </div>
                </div>
            </div>

            {{-- Next Day --}}
            <a href="{{ route('schedule.index', ['date' => $nextDate]) }}"
               class="flex items-center gap-1.5 px-3 py-2 sm:px-4 sm:py-2.5 rounded-xl text-sm font-semibold
                      text-gray-500 hover:text-[#5F402D] hover:bg-[#FCE2CE]/40 transition-all duration-200 group">
                <span class="hidden sm:inline">Besok</span>
                <svg class="w-4 h-4 group-hover:translate-x-0.5 transition-transform" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                </svg>
            </a>
        </div>
    </div>

    {{-- ================================================================ --}}
    {{-- PAGE HEADER --}}
    {{-- ================================================================ --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
        <div>
            <h2 class="text-lg font-bold text-[#3E2723]" style="font-family: 'Poppins', sans-serif;">
                📅 {{ $isToday ? 'Jadwal Hari Ini' : 'Jadwal ' . $parsedDate->translatedFormat('d M Y') }}
            </h2>
            <p class="text-sm text-gray-400 mt-0.5">{{ $parsedDate->translatedFormat('l, d F Y') }}</p>
        </div>

        <div class="flex items-center gap-3">
            {{-- Schedule Count Badge --}}
            @if($schedules->isNotEmpty())
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-2xl text-sm font-semibold
                            bg-[#FCE2CE]/60 text-[#5F402D] border border-[#F5D0B0]/50">
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    {{ $schedules->count() }} Kegiatan
                </div>
            @endif

            {{-- Add Schedule Button --}}
            <button @click="scheduleModalMode = 'add'; scheduleEditId = null; scheduleTitle = ''; scheduleIcon = '☕'; scheduleDate = '{{ $selectedDate }}'; scheduleStartTime = ''; scheduleEndTime = ''; scheduleNote = ''; scheduleModalOpen = true"
                    class="inline-flex items-center gap-2 px-5 py-2.5 rounded-2xl text-sm font-semibold
                           bg-[#FCE2CE] text-[#5F402D] border border-[#F5D0B0]
                           hover:bg-[#F5D0B0] hover:shadow-sm transition-all duration-200">
                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                Tambah Jadwal
            </button>
        </div>
    </div>

    @if($schedules->isNotEmpty())

        {{-- Timeline Container --}}
        <div class="relative">

            {{-- Vertical Line --}}
            <div class="absolute left-[23px] sm:left-[31px] top-0 bottom-0 w-[2px] bg-gradient-to-b from-[#FCE2CE] via-[#F5D0B0]/60 to-[#FCE2CE]/20 rounded-full"></div>

            {{-- Timeline Items --}}
            <div class="space-y-4 sm:space-y-5">
                @foreach($schedules as $index => $schedule)
                    @php
                        // Pre-format times for Alpine.js (always HH:MM string)
                        $startHHMM = $schedule->start_time instanceof \Carbon\Carbon
                            ? $schedule->start_time->format('H:i')
                            : \Carbon\Carbon::parse($schedule->start_time)->format('H:i');
                        $endHHMM = $schedule->end_time instanceof \Carbon\Carbon
                            ? $schedule->end_time->format('H:i')
                            : \Carbon\Carbon::parse($schedule->end_time)->format('H:i');

                        // Detect overnight schedule (end_time < start_time)
                        $isOvernight = $endHHMM < $startHHMM;

                        // Date for edit modal
                        $editDate = $schedule->date instanceof \Carbon\Carbon
                            ? $schedule->date->format('Y-m-d')
                            : $schedule->date;

                        // Duration calculation — account for overnight crossing
                        $startCarbon = \Carbon\Carbon::parse($schedule->start_time);
                        $endCarbon = \Carbon\Carbon::parse($schedule->end_time);
                        if ($isOvernight) {
                            $endCarbon = $endCarbon->copy()->addDay();
                        }
                        $durationMinutes = $startCarbon->diffInMinutes($endCarbon);
                        $hours = intdiv($durationMinutes, 60);
                        $mins = $durationMinutes % 60;
                        $durationText = $hours > 0
                            ? ($mins > 0 ? "{$hours}j {$mins}m" : "{$hours}j")
                            : "{$mins}m";
                    @endphp

                    {{-- Each item is its own Alpine component with auto-updating time state --}}
                    {{-- Only do real-time ticking when viewing today's schedule --}}
                    <div class="relative flex items-start gap-4 sm:gap-5 group"
                         style="animation: fadeSlideIn 0.5s ease-out {{ $index * 0.08 }}s both;"
                         x-data="scheduleItem('{{ $startHHMM }}', '{{ $endHHMM }}', {{ $isToday ? 'true' : 'false' }})"
                         x-init="startTick()">

                        {{-- Timeline Dot — Reactive --}}
                        <div class="relative z-10 flex-shrink-0 mt-5">
                            {{-- Active Pulse Dot --}}
                            <div x-show="isCurrent" x-cloak
                                 class="w-[12px] h-[12px] sm:w-[14px] sm:h-[14px] rounded-full ml-[12px] sm:ml-[18px]
                                        bg-[#5F402D] border-[3px] border-[#FCE2CE] shadow-md shadow-[#5F402D]/20">
                            </div>
                            {{-- Completed Dot --}}
                            <div x-show="isPast && !isCurrent" x-cloak
                                 class="w-[12px] h-[12px] sm:w-[14px] sm:h-[14px] rounded-full ml-[12px] sm:ml-[18px]
                                        bg-[#FCE2CE] border-[3px] border-[#F5D0B0]/60"></div>
                            {{-- Future Dot --}}
                            <div x-show="!isPast && !isCurrent" x-cloak
                                 class="w-[12px] h-[12px] sm:w-[14px] sm:h-[14px] rounded-full ml-[12px] sm:ml-[18px]
                                        bg-white border-[3px] border-[#F5D0B0]/80
                                        group-hover:border-[#5F402D]/40 group-hover:scale-110 transition-all duration-300"></div>
                        </div>

                        {{-- Schedule Card — Reactive classes --}}
                        <div class="flex-1 min-w-0 rounded-2xl sm:rounded-[1.25rem] border transition-all duration-500"
                             :class="isCurrent
                                 ? 'bg-white border-[#E8B896] shadow-lg shadow-[#F5D0B0]/40 ring-2 ring-[#F5D0B0]/50'
                                 : (isPast
                                     ? 'bg-white/60 border-gray-100/60 opacity-60'
                                     : 'bg-white border-gray-100/80 shadow-sm hover:shadow-md hover:border-[#FCE2CE]/60 hover:-translate-y-0.5')">

                            <div class="flex items-center gap-3 sm:gap-4 px-4 py-3.5 sm:px-5 sm:py-4">

                                {{-- Icon Circle — Reactive --}}
                                <div class="flex-shrink-0 w-11 h-11 sm:w-12 sm:h-12 rounded-2xl flex items-center justify-center text-xl sm:text-2xl transition-all duration-500"
                                     :class="isCurrent
                                         ? 'bg-gradient-to-br from-[#FCE2CE] to-[#F5D0B0] shadow-sm scale-110'
                                         : (isPast
                                             ? 'bg-gray-100/80'
                                             : 'bg-[#FEF6EF] group-hover:bg-[#FCE2CE]/60')">
                                    {{ $schedule->icon }}
                                </div>

                                {{-- Title & Time — Reactive --}}
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center gap-2">
                                        <h3 class="text-sm sm:text-[15px] font-semibold truncate transition-colors duration-500"
                                            :class="isCurrent ? 'text-[#3E2723]' : (isPast ? 'text-gray-400' : 'text-gray-700')">
                                            {{ $schedule->title }}
                                        </h3>
                                        {{-- NOW Badge — Reactive with pulse --}}
                                        <span x-show="isCurrent" x-cloak
                                              x-transition:enter="transition ease-out duration-300"
                                              x-transition:enter-start="opacity-0 scale-75"
                                              x-transition:enter-end="opacity-100 scale-100"
                                              x-transition:leave="transition ease-in duration-200"
                                              x-transition:leave-start="opacity-100 scale-100"
                                              x-transition:leave-end="opacity-0 scale-75"
                                              class="flex-shrink-0 inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider
                                                     bg-[#5F402D] text-white shadow-sm animate-pulse">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
                                            Sekarang
                                        </span>
                                    </div>
                                    <p class="text-xs sm:text-[13px] font-medium mt-0.5 transition-colors duration-500 flex items-center flex-wrap gap-1"
                                       :class="isCurrent ? 'text-[#5F402D]' : (isPast ? 'text-gray-300' : 'text-gray-400')">
                                        {{ $startHHMM }} — {{ $endHHMM }}
                                        @if($isOvernight)
                                            <span class="inline-flex items-center gap-0.5 text-[10px] font-semibold text-orange-500 bg-orange-50 px-1.5 py-0.5 rounded-md border border-orange-100/60">
                                                <svg class="w-2.5 h-2.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.752 15.002A9.718 9.718 0 0118 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 003 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 009.002-5.998z" />
                                                </svg>
                                                +1 Hari
                                            </span>
                                        @endif
                                    </p>
                                </div>

                                {{-- Duration Badge — Reactive --}}
                                <div class="hidden sm:flex flex-shrink-0 items-center gap-1.5 px-3 py-1.5 rounded-xl text-xs font-semibold transition-colors duration-500"
                                     :class="isCurrent
                                         ? 'bg-[#FCE2CE]/50 text-[#5F402D]'
                                         : (isPast
                                             ? 'bg-gray-50 text-gray-300'
                                             : 'bg-gray-50 text-gray-400')">
                                    <svg class="w-3.5 h-3.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    {{ $durationText }}
                                </div>

                                {{-- Action Buttons (Edit & Delete) --}}
                                <div class="flex items-center gap-1 flex-shrink-0
                                            sm:opacity-0 sm:translate-x-2 sm:pointer-events-none
                                            sm:group-hover:opacity-100 sm:group-hover:translate-x-0 sm:group-hover:pointer-events-auto
                                            sm:transition-all sm:duration-300 sm:ease-out">
                                    {{-- Edit --}}
                                    <button type="button"
                                            @click="scheduleModalMode = 'edit'; scheduleEditId = {{ $schedule->id }}; scheduleTitle = '{{ addslashes($schedule->title) }}'; scheduleIcon = '{{ $schedule->icon }}'; scheduleDate = '{{ $editDate }}'; scheduleStartTime = '{{ $startHHMM }}'; scheduleEndTime = '{{ $endHHMM }}'; scheduleNote = '{{ addslashes($schedule->note ?? '') }}'; scheduleModalOpen = true"
                                            class="p-2 rounded-xl text-gray-400 hover:text-amber-600 hover:bg-amber-50 transition-colors duration-200"
                                            title="Edit">
                                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                        </svg>
                                    </button>
                                    {{-- Delete --}}
                                    <button type="button"
                                            @click.prevent="deleteScheduleModalOpen = true; scheduleToDeleteUrl = '{{ route('schedule.destroy', $schedule->id) }}'"
                                            class="p-2 rounded-xl text-gray-400 hover:text-red-500 hover:bg-red-50 transition-colors duration-200"
                                            title="Delete">
                                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            {{-- Note (if exists) — Reactive --}}
                            @if($schedule->note)
                                <div class="px-4 pb-3 sm:px-5 sm:pb-4 -mt-1">
                                    <p class="text-xs leading-relaxed pl-14 sm:pl-16 transition-colors duration-500"
                                       :class="isPast ? 'text-gray-300' : 'text-gray-400'">
                                        💬 {{ $schedule->note }}
                                    </p>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Timeline End Indicator --}}
            <div class="relative flex items-center gap-4 sm:gap-5 mt-4 sm:mt-5">
                <div class="relative z-10 flex-shrink-0">
                    <div class="w-[8px] h-[8px] sm:w-[10px] sm:h-[10px] rounded-full bg-[#FCE2CE]/40 border-2 border-[#F5D0B0]/30 ml-[14px] sm:ml-[20px]"></div>
                </div>
                <p class="text-xs text-gray-300 font-medium italic">Akhir jadwal hari ini</p>
            </div>
        </div>

    @else
        {{-- Empty State --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100/50">
            <div class="flex flex-col items-center justify-center py-20 px-4 sm:px-6">
                {{-- Icon --}}
                <div class="w-20 h-20 rounded-3xl bg-[#FCE2CE]/50 flex items-center justify-center mb-6">
                    <svg class="w-10 h-10 text-[#5F402D]/40" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>

                {{-- Text --}}
                <h3 class="text-lg font-bold text-[#3E2723] mb-2" style="font-family: 'Poppins', sans-serif;">
                    Belum Ada Jadwal
                </h3>
                <p class="text-sm text-gray-400 text-center max-w-sm leading-relaxed">
                    @if($isToday)
                        Jadwal hari ini masih kosong. Yuk, mulai atur harimu!
                    @else
                        Belum ada kegiatan yang dijadwalkan untuk tanggal ini.
                    @endif
                </p>

                {{-- Add Button in Empty State --}}
                <button @click="scheduleModalMode = 'add'; scheduleEditId = null; scheduleTitle = ''; scheduleIcon = '☕'; scheduleDate = '{{ $selectedDate }}'; scheduleStartTime = ''; scheduleEndTime = ''; scheduleNote = ''; scheduleModalOpen = true"
                        class="mt-6 inline-flex items-center gap-2 px-6 py-3 rounded-2xl text-sm font-semibold
                               bg-[#FCE2CE] text-[#5F402D] border border-[#F5D0B0]
                               hover:bg-[#F5D0B0] hover:shadow-sm transition-all duration-200">
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    Tambah Jadwal
                </button>

                {{-- Decorative dots --}}
                <div class="flex items-center gap-1.5 mt-8">
                    <div class="w-2 h-2 rounded-full bg-[#FCE2CE]"></div>
                    <div class="w-2 h-2 rounded-full bg-[#FCE2CE]/60"></div>
                    <div class="w-2 h-2 rounded-full bg-[#FCE2CE]/30"></div>
                </div>
            </div>
        </div>
    @endif

    {{-- ================================================================ --}}
    {{-- SCHEDULE ITEM ALPINE COMPONENT + GLOW ANIMATION --}}
    {{-- ================================================================ --}}
    <style>
        @keyframes fadeSlideIn {
            from { opacity: 0; transform: translateY(12px); }
            to   { opacity: 1; transform: translateY(0); }
        }



        /* Prevent x-cloak flicker */
        [x-cloak] { display: none !important; }
    </style>

    <script>
        /**
         * Alpine.js component for each schedule timeline item.
         * Compares browser time against start/end and auto-updates every 60s.
         * Only runs the real-time tick when viewing today's schedule.
         */
        document.addEventListener('alpine:init', () => {
            Alpine.data('scheduleItem', (start, end, isToday) => ({
                start: start,
                end: end,
                isToday: isToday,
                isCurrent: false,
                isPast: false,
                _interval: null,

                toMinutes(hhmm) {
                    const [h, m] = hhmm.split(':').map(Number);
                    return h * 60 + m;
                },

                nowMinutes() {
                    const d = new Date();
                    return d.getHours() * 60 + d.getMinutes();
                },

                isOvernight() {
                    return this.toMinutes(this.end) <= this.toMinutes(this.start);
                },

                tick() {
                    if (!this.isToday) {
                        const dateStr = '{{ $selectedDate }}';
                        const today = new Date();
                        const viewDate = new Date(dateStr + 'T00:00:00');
                        today.setHours(0,0,0,0);

                        if (viewDate < today) {
                            this.isPast = true;
                            this.isCurrent = false;
                        } else {
                            this.isPast = false;
                            this.isCurrent = false;
                        }
                        return;
                    }

                    const now   = this.nowMinutes();
                    const start = this.toMinutes(this.start);
                    const end   = this.toMinutes(this.end);

                    if (this.isOvernight()) {
                        // Overnight: active from start until midnight, OR from midnight until end
                        this.isCurrent = now >= start || now < end;
                        this.isPast    = now >= end && now < start;
                    } else {
                        this.isCurrent = now >= start && now < end;
                        this.isPast    = now >= end;
                    }
                },

                startTick() {
                    this.tick();
                    if (this.isToday) {
                        this._interval = setInterval(() => this.tick(), 60000);
                    }
                },

                destroy() {
                    if (this._interval) clearInterval(this._interval);
                }
            }));
        });
    </script>

@endsection
