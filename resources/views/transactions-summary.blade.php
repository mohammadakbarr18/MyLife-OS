@extends('layouts.app')

@section('title', 'Laporan Keuangan')
@section('page-title', 'Laporan Keuangan')
@section('page-subtitle', 'Ringkasan transaksimu berdasarkan periode')

@section('content')

    {{-- Back Link --}}
    <a href="{{ route('transactions') }}"
       class="inline-flex items-center gap-2 text-sm font-semibold text-gray-500 hover:text-[#5F402D] mb-6 group transition-colors duration-200">
        <svg class="w-4 h-4 group-hover:-translate-x-0.5 transition-transform duration-200" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
        </svg>
        Kembali ke Keuangan
    </a>

    @if(count($groupedTransactions) > 0)

        @foreach($groupedTransactions as $yearKey => $yearData)
            {{-- ============== Year Section ============== --}}
            <div class="mb-10">

                {{-- Year Header --}}
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-5">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-[#FCE2CE] flex items-center justify-center shadow-sm">
                            <span class="text-lg font-bold text-[#5F402D]">📅</span>
                        </div>
                        <h2 class="text-2xl font-extrabold text-[#3E2723] tracking-tight" style="font-family: 'Poppins', sans-serif;">
                            {{ $yearData['year'] }}
                        </h2>
                    </div>

                    {{-- Yearly Totals --}}
                    <div class="flex items-center gap-4">
                        <div class="flex items-center gap-1.5 px-3 py-1.5 bg-emerald-50 rounded-full border border-emerald-200/60">
                            <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                            <span class="text-xs font-bold text-emerald-700">+Rp {{ number_format($yearData['total_income'], 0, ',', '.') }}</span>
                        </div>
                        <div class="flex items-center gap-1.5 px-3 py-1.5 bg-red-50 rounded-full border border-red-200/60">
                            <span class="w-2 h-2 rounded-full bg-red-500"></span>
                            <span class="text-xs font-bold text-red-600">-Rp {{ number_format($yearData['total_expense'], 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>

                {{-- Monthly Cards Grid --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($yearData['months'] as $monthKey => $monthData)
                        @php
                            $netBalance = $monthData['total_income'] - $monthData['total_expense'];
                        @endphp

                        <div class="bg-white rounded-2xl border border-gray-100/80 shadow-sm p-5
                                    hover:shadow-md hover:border-[#FCE2CE]/60 transition-all duration-300">
                            {{-- Month Title --}}
                            <div class="flex items-center gap-2 mb-4">
                                <div class="w-8 h-8 rounded-lg bg-[#FEF6EF] flex items-center justify-center">
                                    <span class="text-sm">📆</span>
                                </div>
                                <h3 class="text-sm font-bold text-[#3E2723]" style="font-family: 'Poppins', sans-serif;">
                                    {{ $monthData['month_name'] }} {{ $monthData['year'] }}
                                </h3>
                            </div>

                            {{-- Income --}}
                            <div class="flex items-center justify-between py-2.5 border-b border-gray-50">
                                <div class="flex items-center gap-2">
                                    <span class="w-2.5 h-2.5 rounded-full bg-emerald-400"></span>
                                    <span class="text-xs font-medium text-gray-500">Pemasukan</span>
                                </div>
                                <span class="text-sm font-bold text-emerald-600">
                                    +Rp {{ number_format($monthData['total_income'], 0, ',', '.') }}
                                </span>
                            </div>

                            {{-- Expense --}}
                            <div class="flex items-center justify-between py-2.5 border-b border-gray-50">
                                <div class="flex items-center gap-2">
                                    <span class="w-2.5 h-2.5 rounded-full bg-red-400"></span>
                                    <span class="text-xs font-medium text-gray-500">Pengeluaran</span>
                                </div>
                                <span class="text-sm font-bold text-red-500">
                                    -Rp {{ number_format($monthData['total_expense'], 0, ',', '.') }}
                                </span>
                            </div>

                            {{-- Net Balance --}}
                            <div class="flex items-center justify-between pt-3">
                                <span class="text-xs font-semibold text-gray-400">Saldo Bersih</span>
                                <span class="text-sm font-extrabold {{ $netBalance >= 0 ? 'text-emerald-600' : 'text-red-500' }}">
                                    {{ $netBalance >= 0 ? '+' : '-' }}Rp {{ number_format(abs($netBalance), 0, ',', '.') }}
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach

    @else
        {{-- Empty State --}}
        <div class="flex flex-col items-center justify-center py-20 px-6">
            <div class="w-20 h-20 rounded-3xl bg-[#FCE2CE]/50 flex items-center justify-center mb-6">
                <svg class="w-10 h-10 text-[#5F402D]/40" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" />
                </svg>
            </div>
            <h3 class="text-lg font-bold text-[#3E2723] mb-2" style="font-family: 'Poppins', sans-serif;">
                Belum Ada Laporan
            </h3>
            <p class="text-sm text-gray-400 text-center max-w-sm leading-relaxed">
                Mulai tambahkan transaksi untuk melihat ringkasan keuangan bulanan dan tahunanmu di sini.
            </p>
            <div class="flex items-center gap-1.5 mt-8">
                <div class="w-2 h-2 rounded-full bg-[#FCE2CE]"></div>
                <div class="w-2 h-2 rounded-full bg-[#FCE2CE]/60"></div>
                <div class="w-2 h-2 rounded-full bg-[#FCE2CE]/30"></div>
            </div>
        </div>
    @endif

@endsection
