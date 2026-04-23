@extends('layouts.app')

@section('title', 'Beranda')
@section('page-title', 'Beranda')
@section('page-subtitle', 'Selamat datang kembali, ' . (Auth::user()->name ?? 'User') . '!')

@section('content')

    {{-- ============================================================== --}}
    {{-- SECTION 1: FINANCIAL OVERVIEW                                  --}}
    {{-- ============================================================== --}}

    {{-- Section Header: Financial Overview --}}
    <div class="mb-6">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="text-lg font-bold text-[#3E2723]" style="font-family: 'Poppins', sans-serif;">
                    📊 Ringkasan Keuangan
                </h2>
                <p class="text-sm text-gray-400 mt-0.5">Ringkasan keuanganmu bulan ini</p>
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
                    Pemasukan
                </button>
                <button @click="transactionModalOpen = true; transactionType = 'expense'"
                        class="inline-flex items-center gap-2 px-5 py-2.5 rounded-2xl text-sm font-semibold
                               bg-red-50/90 text-red-600 border border-red-200
                               hover:bg-red-100 hover:shadow-sm transition-all duration-200">
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    Pengeluaran
                </button>
            </div>
        </div>
    </div>

    {{-- Financial Stats Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-4xl mx-auto">

        {{-- Card 1: Total Income --}}
        <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100/50
                    hover:shadow-md transition-shadow duration-300">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-10 h-10 rounded-xl bg-emerald-50 flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-emerald-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18 9 11.25l4.306 4.306a11.95 11.95 0 0 1 5.814-5.518l2.74-1.22m0 0-5.94-2.281m5.94 2.28-2.28 5.941" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500 font-medium leading-tight">Pemasukan Bulan Ini</p>
                    <p class="text-xs text-gray-400">Pemasukan</p>
                </div>
            </div>
            <p class="text-2xl font-extrabold text-emerald-600 whitespace-nowrap">
                Rp {{ $formattedIncome }}
            </p>
        </div>

        {{-- Card 2: Total Expense --}}
        <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100/50
                    hover:shadow-md transition-shadow duration-300">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-10 h-10 rounded-xl bg-red-50 flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-red-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6 9 12.75l4.286-4.286a11.948 11.948 0 0 1 4.306 6.43l.776 2.898m0 0 3.182-5.511m-3.182 5.51-5.511-3.181" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500 font-medium leading-tight">Pengeluaran Bulan Ini</p>
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
            📋 Aktivitas Terkini
        </h2>
        <p class="text-sm text-gray-400 mt-0.5">Transaksi terbaru, tugas, dan jadwal hari ini</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- Widget A: Recent Transactions (2 columns) --}}
        <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-gray-100/50 overflow-hidden">
            {{-- Widget Header --}}
            <div class="flex items-center justify-between px-4 sm:px-6 py-4 sm:py-5 border-b border-gray-100">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-xl bg-[#FCE2CE] flex items-center justify-center">
                        <svg class="w-4.5 h-4.5 text-[#5F402D]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 21 3 16.5m0 0L7.5 12M3 16.5h13.5m0-13.5L21 7.5m0 0L16.5 12M21 7.5H7.5" />
                        </svg>
                    </div>
                    <h3 class="text-base font-bold text-[#3E2723]" style="font-family: 'Poppins', sans-serif;">
                        Aktivitas Terakhir
                    </h3>
                </div>
                <a href="{{ route('transactions') }}"
                   class="text-sm font-semibold text-[#5F402D] hover:text-[#3E2723] transition-colors flex items-center gap-1">
                    Lihat Semua
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                    </svg>
                </a>
            </div>

            {{-- Transaction Items --}}
            @if($recentTransactions->isNotEmpty())

                {{-- ========== MOBILE: Card Layout (visible < md) ========== --}}
                <div class="md:hidden divide-y divide-gray-100/80">
                    @foreach($recentTransactions as $transaction)
                        <div class="px-4 py-3.5 hover:bg-[#FEF6EF]/50 transition-colors duration-150">
                            <div class="flex items-center justify-between gap-3">
                                {{-- Left: Icon + Details --}}
                                <div class="flex items-center gap-3 min-w-0">
                                    <div class="w-9 h-9 rounded-lg flex items-center justify-center flex-shrink-0 text-base
                                                {{ $transaction->type === 'income' ? 'bg-emerald-50' : 'bg-red-50' }}">
                                        @if($transaction->category)
                                            {{ $transaction->category->icon }}
                                        @else
                                            {{ $transaction->type === 'income' ? '💰' : '💸' }}
                                        @endif
                                    </div>
                                    <div class="min-w-0">
                                        <p class="text-sm font-semibold text-[#3E2723] truncate">{{ $transaction->description ?: 'Tanpa deskripsi' }}</p>
                                        <p class="text-xs text-gray-400 mt-0.5">{{ $transaction->date->format('d M') }}</p>
                                    </div>
                                </div>
                                {{-- Right: Amount --}}
                                <p class="text-sm font-bold flex-shrink-0 {{ $transaction->type === 'income' ? 'text-emerald-600' : 'text-red-500' }}">
                                    {{ $transaction->type === 'income' ? '+' : '-' }}Rp {{ number_format($transaction->amount, 0, ',', '.') }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- ========== DESKTOP: Table Layout (visible ≥ md) ========== --}}
                <div class="hidden md:block overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="text-left">
                                <th class="px-6 py-3.5 text-xs font-semibold text-gray-400 uppercase tracking-wider">Tanggal</th>
                                <th class="px-6 py-3.5 text-xs font-semibold text-gray-400 uppercase tracking-wider">Deskripsi</th>
                                <th class="px-6 py-3.5 text-xs font-semibold text-gray-400 uppercase tracking-wider">Kategori</th>
                                <th class="px-6 py-3.5 text-xs font-semibold text-gray-400 uppercase tracking-wider text-right">Jumlah</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @foreach($recentTransactions as $transaction)
                                <tr class="hover:bg-[#FEF6EF]/50 transition-colors duration-150">
                                    <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                        {{ $transaction->date->format('d M') }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <p class="text-sm font-medium text-gray-700">{{ $transaction->description }}</p>
                                    </td>
                                    <td class="px-6 py-4">
                                        @if($transaction->category)
                                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-semibold
                                                         bg-gray-50 text-gray-700 border border-gray-200/60">
                                                {{ $transaction->category->icon }} {{ $transaction->category->name }}
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold
                                                         bg-gray-50 text-gray-500 border border-gray-200/60">
                                                Tanpa Kategori
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
                {{-- Empty state --}}
                <div class="px-4 sm:px-6 py-12 text-center">
                    <p class="text-sm text-gray-400">Belum ada transaksi. Yuk, mulai catat keuanganmu!</p>
                </div>
            @endif
        </div>

        {{-- Widget B: Today's Tasks (1 column) --}}
        @php
            $completedCount = $todayTodos->where('status', 'completed')->count();
            $totalTodoCount = $todayTodos->count();
        @endphp
        <div class="lg:col-span-1 bg-white rounded-2xl shadow-sm border border-gray-100/50 overflow-hidden"
             x-data="{ completedCount: {{ $completedCount }}, totalCount: {{ $totalTodoCount }} }">
            {{-- Widget Header --}}
            <div class="flex items-center justify-between px-4 sm:px-6 py-4 sm:py-5 border-b border-gray-100">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-xl bg-[#FCE2CE] flex items-center justify-center">
                        <svg class="w-4.5 h-4.5 text-[#5F402D]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                    </div>
                    <h3 class="text-base font-bold text-[#3E2723]" style="font-family: 'Poppins', sans-serif;">
                        Daftar Tugas
                    </h3>
                </div>
                <a href="{{ route('todo') }}"
                   class="text-sm font-semibold text-[#5F402D] hover:text-[#3E2723] transition-colors flex items-center gap-1">
                    Semua
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                    </svg>
                </a>
            </div>

            {{-- Task List --}}
            <div class="px-4 sm:px-6 py-3 sm:py-4 space-y-1">
                @forelse($todayTodos as $todo)
                    <label class="flex items-center gap-3 px-3 py-3 rounded-xl cursor-pointer
                                  hover:bg-[#FEF6EF]/70 transition-colors duration-150 group"
                           x-data="{ completed: {{ $todo->status === 'completed' ? 'true' : 'false' }} }">
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
                               class="w-5 h-5 rounded-lg border-2 border-gray-300 text-[#5F402D]
                                      focus:ring-[#FCE2CE] focus:ring-offset-0 transition-colors flex-shrink-0 cursor-pointer">
                        <span class="text-sm font-medium transition-colors"
                              :class="completed ? 'text-gray-400 line-through' : 'text-gray-700 group-hover:text-[#3E2723]'">
                            {{ $todo->title }}
                        </span>
                    </label>
                @empty
                    <div class="py-8 text-center">
                        <p class="text-sm text-gray-400">Belum ada tugas hari ini. Yuk, tambahkan satu!</p>
                    </div>
                @endforelse
            </div>

            {{-- Task Summary Footer (reactive) --}}
            <div class="px-4 sm:px-6 py-3 sm:py-4 border-t border-gray-100">
                <div class="flex items-center justify-between">
                    <p class="text-xs text-gray-400 font-medium">Selesai</p>
                    <p class="text-xs font-bold text-[#5F402D]" x-text="completedCount + ' / ' + totalCount"></p>
                </div>
                {{-- Progress Bar --}}
                <div class="mt-2 w-full h-1.5 bg-gray-100 rounded-full overflow-hidden">
                    <div class="h-full bg-[#FCE2CE] rounded-full transition-all duration-500"
                         :style="'width: ' + (totalCount > 0 ? Math.round((completedCount / totalCount) * 100) : 0) + '%'"></div>
                </div>
            </div>
        </div>

    </div>

    {{-- ============================================================== --}}
    {{-- SECTION 3: TODAY'S SCHEDULE WIDGET                             --}}
    {{-- ============================================================== --}}

    <div class="mt-8">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100/50 overflow-hidden">
            {{-- Widget Header --}}
            <div class="flex items-center justify-between px-4 sm:px-6 py-4 sm:py-5 border-b border-gray-100">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-xl bg-[#FCE2CE] flex items-center justify-center">
                        <svg class="w-4.5 h-4.5 text-[#5F402D]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-base font-bold text-[#3E2723]" style="font-family: 'Poppins', sans-serif;">
                            Jadwal Hari Ini
                        </h3>
                        <p class="text-xs text-gray-400 mt-0.5">{{ now()->translatedFormat('l, d F Y') }}</p>
                    </div>
                </div>
                <a href="{{ route('schedule.index') }}"
                   class="text-sm font-semibold text-[#5F402D] hover:text-[#3E2723] transition-colors flex items-center gap-1">
                    Buka Planner
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                    </svg>
                </a>
            </div>

            {{-- Schedule Timeline --}}
            @if($todaySchedules->isNotEmpty())
                <div class="px-4 sm:px-6 py-4 sm:py-5">
                    <div class="relative">
                        {{-- Vertical Line --}}
                        <div class="absolute left-[15px] top-2 bottom-2 w-[2px] bg-gradient-to-b from-[#FCE2CE] via-[#F5D0B0]/50 to-[#FCE2CE]/20 rounded-full"></div>

                        {{-- Schedule Items --}}
                        <div class="space-y-1">
                            @foreach($todaySchedules as $schedule)
                                @php
                                    $sStartHHMM = $schedule->start_time instanceof \Carbon\Carbon
                                        ? $schedule->start_time->format('H:i')
                                        : \Carbon\Carbon::parse($schedule->start_time)->format('H:i');
                                    $sEndHHMM = $schedule->end_time instanceof \Carbon\Carbon
                                        ? $schedule->end_time->format('H:i')
                                        : \Carbon\Carbon::parse($schedule->end_time)->format('H:i');
                                    $sIsOvernight = $sEndHHMM < $sStartHHMM;
                                @endphp
                                <div class="relative flex items-center gap-3 pl-1 py-2.5 rounded-xl hover:bg-[#FEF6EF]/50 transition-colors duration-150 group">
                                    {{-- Dot --}}
                                    <div class="relative z-10 flex-shrink-0">
                                        <div class="w-[10px] h-[10px] rounded-full bg-[#FCE2CE] border-[2.5px] border-[#F5D0B0]/80 group-hover:border-[#5F402D]/40 group-hover:scale-125 transition-all duration-300"></div>
                                    </div>

                                    {{-- Icon --}}
                                    <div class="flex-shrink-0 w-9 h-9 rounded-xl bg-[#FEF6EF] group-hover:bg-[#FCE2CE]/50 flex items-center justify-center text-lg transition-colors duration-200">
                                        {{ $schedule->icon }}
                                    </div>

                                    {{-- Content --}}
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-semibold text-gray-700 truncate group-hover:text-[#3E2723] transition-colors">{{ $schedule->title }}</p>
                                        <p class="text-xs text-gray-400 mt-0.5 flex items-center gap-1">
                                            {{ $sStartHHMM }} — {{ $sEndHHMM }}
                                            @if($sIsOvernight)
                                                <span class="inline-flex items-center gap-0.5 text-[9px] font-bold text-orange-500 bg-orange-50 px-1 py-0.5 rounded border border-orange-100/60">
                                                    🌙 +1
                                                </span>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- Footer --}}
                <div class="px-4 sm:px-6 py-3 border-t border-gray-100">
                    <div class="flex items-center justify-between">
                        <p class="text-xs text-gray-400 font-medium">Total kegiatan</p>
                        <p class="text-xs font-bold text-[#5F402D]">{{ $todaySchedules->count() }} jadwal</p>
                    </div>
                </div>
            @else
                {{-- Beautiful Empty State --}}
                <div class="flex flex-col items-center justify-center py-14 px-4 sm:px-6">
                    <div class="w-16 h-16 rounded-2xl bg-[#FCE2CE]/30 flex items-center justify-center mb-5">
                        <svg class="w-8 h-8 text-[#5F402D]/30" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                    </div>
                    <h4 class="text-base font-bold text-[#3E2723] mb-1.5" style="font-family: 'Poppins', sans-serif;">Hari Ini Masih Kosong</h4>
                    <p class="text-sm text-gray-400 text-center max-w-xs leading-relaxed mb-5">
                        Belum ada jadwal untuk hari ini. Rencanakan harimu lewat halaman Jadwal!
                    </p>
                    <a href="{{ route('schedule.index') }}"
                       class="inline-flex items-center gap-2 px-5 py-2.5 rounded-2xl text-sm font-semibold
                              bg-[#FCE2CE] text-[#5F402D] border border-[#F5D0B0]
                              hover:bg-[#F5D0B0] hover:shadow-sm transition-all duration-200">
                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                        Buka Planner
                    </a>
                    {{-- Decorative dots --}}
                    <div class="flex items-center gap-1.5 mt-6">
                        <div class="w-1.5 h-1.5 rounded-full bg-[#FCE2CE]"></div>
                        <div class="w-1.5 h-1.5 rounded-full bg-[#FCE2CE]/60"></div>
                        <div class="w-1.5 h-1.5 rounded-full bg-[#FCE2CE]/30"></div>
                    </div>
                </div>
            @endif
        </div>
    </div>

@endsection
