<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Dashboard') - {{ config('app.name', 'MyLife OS') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#FEF6EF] font-sans text-[#424242] antialiased overflow-x-hidden"
      x-data="{ transactionModalOpen: false, transactionType: 'income', todoModalOpen: false, editTodoModalOpen: false, editTodoId: null, editTodoTitle: '', editTodoPriority: 'medium', editTodoDueDate: '', deleteModalOpen: false, taskToDeleteUrl: '' }">

    <div class="min-h-screen flex">

        <!-- ================================================================== -->
        <!-- SIDEBAR (Desktop ≥ 1024px) -->
        <!-- ================================================================== -->
        <aside id="sidebar" class="hidden lg:flex lg:flex-col lg:fixed lg:inset-y-0 lg:left-0 lg:w-64 lg:z-40
                                    bg-white rounded-r-3xl shadow-lg">

            <!-- Logo / Brand -->
            <div class="flex items-center gap-3 px-7 pt-8 pb-6">
                <div class="w-10 h-10 rounded-2xl bg-[#FCE2CE] flex items-center justify-center shadow-sm">
                    <svg class="w-5 h-5 text-[#5F402D]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                    </svg>
                </div>
                <span class="text-lg font-bold text-[#3E2723]" style="font-family: 'Poppins', sans-serif;">MyLife OS</span>
            </div>

            <!-- Navigation Links -->
            <nav class="flex-1 px-4 space-y-1.5 mt-2">
                <!-- Dashboard -->
                <a href="{{ route('dashboard') }}"
                   class="sidebar-link group flex items-center gap-3.5 px-4 py-3 rounded-2xl text-sm font-semibold transition-all duration-200
                          {{ request()->routeIs('dashboard') ? 'bg-[#FCE2CE] text-[#5F402D] shadow-sm' : 'text-gray-500 hover:bg-[#FEF6EF] hover:text-[#5F402D]' }}">
                    <svg class="w-5 h-5 transition-colors {{ request()->routeIs('dashboard') ? 'text-[#5F402D]' : 'text-gray-400 group-hover:text-[#5F402D]' }}" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                    </svg>
                    Dashboard
                </a>

                <!-- Transactions -->
                <a href="{{ route('transactions') }}"
                   class="sidebar-link group flex items-center gap-3.5 px-4 py-3 rounded-2xl text-sm font-semibold transition-all duration-200
                          {{ request()->routeIs('transactions*') ? 'bg-[#FCE2CE] text-[#5F402D] shadow-sm' : 'text-gray-500 hover:bg-[#FEF6EF] hover:text-[#5F402D]' }}">
                    <svg class="w-5 h-5 transition-colors {{ request()->routeIs('transactions*') ? 'text-[#5F402D]' : 'text-gray-400 group-hover:text-[#5F402D]' }}" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                    </svg>
                    Transactions
                </a>

                <!-- To-Do List -->
                <a href="{{ route('todo') }}"
                   class="sidebar-link group flex items-center gap-3.5 px-4 py-3 rounded-2xl text-sm font-semibold transition-all duration-200
                          {{ request()->routeIs('todo*') ? 'bg-[#FCE2CE] text-[#5F402D] shadow-sm' : 'text-gray-500 hover:bg-[#FEF6EF] hover:text-[#5F402D]' }}">
                    <svg class="w-5 h-5 transition-colors {{ request()->routeIs('todo*') ? 'text-[#5F402D]' : 'text-gray-400 group-hover:text-[#5F402D]' }}" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                    </svg>
                    To-Do List
                </a>

                <!-- Settings -->
                <a href="{{ route('settings') }}"
                   class="sidebar-link group flex items-center gap-3.5 px-4 py-3 rounded-2xl text-sm font-semibold transition-all duration-200
                          {{ request()->routeIs('settings*') ? 'bg-[#FCE2CE] text-[#5F402D] shadow-sm' : 'text-gray-500 hover:bg-[#FEF6EF] hover:text-[#5F402D]' }}">
                    <svg class="w-5 h-5 transition-colors {{ request()->routeIs('settings*') ? 'text-[#5F402D]' : 'text-gray-400 group-hover:text-[#5F402D]' }}" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.066 2.573c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.573 1.066c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.066-2.573c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    Settings
                </a>
            </nav>

            <!-- User Section (Bottom of Sidebar) -->
            <div class="px-4 pb-6">
                <div class="border-t border-gray-100 pt-4">
                    <div class="relative" x-data="{ open: false }">
                        <!-- User Button -->
                        <button @click="open = !open"
                                class="w-full flex items-center gap-3 px-4 py-3 rounded-2xl hover:bg-[#FEF6EF] transition-all duration-200 group">
                            <!-- Avatar -->
                            <div class="w-9 h-9 rounded-full bg-[#FCE2CE] flex items-center justify-center flex-shrink-0 shadow-sm">
                                <span class="text-sm font-bold text-[#5F402D]">
                                    {{ substr(Auth::user()->name ?? 'U', 0, 1) }}
                                </span>
                            </div>
                            <!-- Name & Email -->
                            <div class="flex-1 min-w-0 text-left">
                                <p class="text-sm font-semibold text-[#3E2723] truncate">{{ Auth::user()->name ?? 'User' }}</p>
                                <p class="text-xs text-gray-400 truncate">{{ Auth::user()->email ?? '' }}</p>
                            </div>
                            <!-- Chevron -->
                            <svg class="w-4 h-4 text-gray-400 transition-transform duration-200" :class="{ 'rotate-180': open }" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7" />
                            </svg>
                        </button>

                        <!-- Dropdown Menu -->
                        <div x-show="open"
                             x-transition:enter="transition ease-out duration-150"
                             x-transition:enter-start="opacity-0 -translate-y-1"
                             x-transition:enter-end="opacity-100 translate-y-0"
                             x-transition:leave="transition ease-in duration-100"
                             x-transition:leave-start="opacity-100 translate-y-0"
                             x-transition:leave-end="opacity-0 -translate-y-1"
                             @click.outside="open = false"
                             class="absolute bottom-full left-0 right-0 mb-2 bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden z-50"
                             style="display: none;">
                            <a href="{{ route('settings') }}" class="flex items-center gap-3 px-4 py-3 text-sm text-gray-600 hover:bg-[#FEF6EF] hover:text-[#5F402D] transition-colors">
                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                Profil
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 text-sm text-red-500 hover:bg-red-50 transition-colors">
                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                    </svg>
                                    Keluar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </aside>

        <!-- ================================================================== -->
        <!-- MAIN CONTENT AREA -->
        <!-- ================================================================== -->
        <div class="flex-1 flex flex-col min-h-screen lg:ml-64">

            <!-- ============================================================== -->
            <!-- TOP BAR (Mobile) -->
            <!-- ============================================================== -->
            <header class="sticky top-0 z-30 bg-[#FEF6EF]/80 backdrop-blur-lg lg:hidden">
                <div class="flex items-center justify-between px-5 py-4">
                    <!-- Logo -->
                    <div class="flex items-center gap-2.5">
                        <div class="w-9 h-9 rounded-xl bg-[#FCE2CE] flex items-center justify-center shadow-sm">
                            <svg class="w-4.5 h-4.5 text-[#5F402D]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                            </svg>
                        </div>
                        <span class="text-base font-bold text-[#3E2723]" style="font-family: 'Poppins', sans-serif;">MyLife OS</span>
                    </div>
                    <!-- User Avatar -->
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-full bg-[#FCE2CE] flex items-center justify-center shadow-sm">
                            <span class="text-sm font-bold text-[#5F402D]">
                                {{ substr(Auth::user()->name ?? 'U', 0, 1) }}
                            </span>
                        </div>
                    </div>
                </div>
            </header>

            <!-- ============================================================== -->
            <!-- DESKTOP TOP BAR -->
            <!-- ============================================================== -->
            <header class="hidden lg:block sticky top-0 z-50 bg-[#FEF6EF]/90 backdrop-blur-md border-b border-gray-200/50">
                <div class="flex items-end justify-between px-8 pt-6 pb-6 mb-0">
                    {{-- Left Side: Page Title & Subtitle --}}
                    <div>
                        <h1 class="text-4xl font-extrabold text-[#3E2723] tracking-tight" style="font-family: 'Poppins', sans-serif;">
                            @yield('page-title', 'Dashboard')
                        </h1>
                        <p class="text-base font-medium text-gray-500 mt-1">@yield('page-subtitle', 'Selamat datang kembali, ' . (Auth::user()->name ?? 'User') . '!')</p>
                    </div>

                    {{-- Right Side: Date Widget --}}
                    <div class="flex items-center gap-3">
                        {{-- Date Pill Widget --}}
                        <div class="bg-white px-4 py-2 rounded-full shadow-sm text-sm font-medium text-[#5F402D] border border-gray-100 flex items-center gap-2">
                            <svg class="w-4 h-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                            </svg>
                            {{ now()->translatedFormat('D, d M Y') }}
                        </div>
                    </div>
                </div>
            </header>

            <!-- ============================================================== -->
            <!-- PAGE CONTENT -->
            <!-- ============================================================== -->
            <main class="flex-1 px-5 py-6 lg:px-8 lg:pt-8 pb-28 lg:pb-8">
                @yield('content')
            </main>

        </div>
    </div>

    <!-- ==================================================================== -->
    <!-- BOTTOM NAVIGATION BAR (Mobile < 1024px) -->
    <!-- ==================================================================== -->
    <nav class="lg:hidden fixed bottom-0 inset-x-0 z-50 bg-white shadow-[0_-4px_20px_rgba(0,0,0,0.06)] border-t border-gray-100/50">
        <div class="flex items-center justify-around px-2 py-2">

            <!-- Dashboard -->
            <a href="{{ route('dashboard') }}"
               class="flex flex-col items-center gap-1 py-1.5 px-3 rounded-2xl transition-all duration-200
                      {{ request()->routeIs('dashboard') ? 'text-[#5F402D]' : 'text-gray-400' }}">
                <div class="p-1.5 rounded-xl transition-colors {{ request()->routeIs('dashboard') ? 'bg-[#FCE2CE]' : '' }}">
                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                    </svg>
                </div>
                <span class="text-[10px] font-semibold">Dashboard</span>
            </a>

            <!-- Transactions -->
            <a href="{{ route('transactions') }}"
               class="flex flex-col items-center gap-1 py-1.5 px-3 rounded-2xl transition-all duration-200
                      {{ request()->routeIs('transactions*') ? 'text-[#5F402D]' : 'text-gray-400' }}">
                <div class="p-1.5 rounded-xl transition-colors {{ request()->routeIs('transactions*') ? 'bg-[#FCE2CE]' : '' }}">
                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                    </svg>
                </div>
                <span class="text-[10px] font-semibold">Transactions</span>
            </a>

            <!-- To-Do List -->
            <a href="{{ route('todo') }}"
               class="flex flex-col items-center gap-1 py-1.5 px-3 rounded-2xl transition-all duration-200
                      {{ request()->routeIs('todo*') ? 'text-[#5F402D]' : 'text-gray-400' }}">
                <div class="p-1.5 rounded-xl transition-colors {{ request()->routeIs('todo*') ? 'bg-[#FCE2CE]' : '' }}">
                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                    </svg>
                </div>
                <span class="text-[10px] font-semibold">To-Do</span>
            </a>

            <!-- Settings -->
            <a href="{{ route('settings') }}"
               class="flex flex-col items-center gap-1 py-1.5 px-3 rounded-2xl transition-all duration-200
                      {{ request()->routeIs('settings*') ? 'text-[#5F402D]' : 'text-gray-400' }}">
                <div class="p-1.5 rounded-xl transition-colors {{ request()->routeIs('settings*') ? 'bg-[#FCE2CE]' : '' }}">
                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.066 2.573c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.573 1.066c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.066-2.573c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </div>
                <span class="text-[10px] font-semibold">Settings</span>
            </a>

        </div>

        <!-- Safe area spacer for phones with home indicator -->
        <div class="h-[env(safe-area-inset-bottom)]"></div>
    </nav>

    <!-- ==================================================================== -->
    <!-- TRANSACTION MODAL -->
    <!-- ==================================================================== -->
    <div x-show="transactionModalOpen" style="display: none;" class="relative z-[100]" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <!-- Background backdrop -->
        <div x-show="transactionModalOpen"
             x-transition:enter="ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm transition-opacity"></div>

        <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
            <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
                <!-- Modal panel -->
                <div x-show="transactionModalOpen"
                     @click.away="transactionModalOpen = false"
                     x-transition:enter="ease-out duration-300"
                     x-transition:enter-start="opacity-0 translate-y-8 sm:translate-y-0 sm:scale-95"
                     x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave="ease-in duration-200"
                     x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave-end="opacity-0 translate-y-8 sm:translate-y-0 sm:scale-95"
                     class="relative transform overflow-hidden rounded-[2rem] bg-white text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-[480px] border border-white/60">
                    
                    <form action="{{ route('transactions.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="type" :value="transactionType">
                        
                        <div class="bg-white px-5 pb-5 pt-6 sm:px-8 sm:pb-8 sm:pt-8 relative">
                            <!-- Close Button -->
                            <button type="button" @click="transactionModalOpen = false" class="absolute top-6 right-6 p-2 rounded-full text-gray-400 hover:bg-gray-100 hover:text-gray-600 transition-colors">
                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>

                            <div class="sm:flex sm:items-center sm:flex-col">
                                <!-- Modal Header icon -->
                                <div class="mx-auto flex h-12 w-12 sm:h-16 sm:w-16 flex-shrink-0 items-center justify-center rounded-2xl sm:rounded-3xl transition-colors duration-300 shadow-sm"
                                     :class="transactionType === 'income' ? 'bg-gradient-to-br from-emerald-100 to-emerald-50 text-emerald-600' : 'bg-gradient-to-br from-red-100 to-red-50 text-red-600'">
                                    <svg class="h-6 w-6 sm:h-8 sm:w-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div class="mt-3 sm:mt-5 text-center w-full">
                                    <h3 class="text-lg sm:text-2xl font-extrabold text-[#3E2723] tracking-tight" id="modal-title" style="font-family: 'Poppins', sans-serif;" 
                                        x-text="transactionType === 'income' ? 'Tambah Income' : 'Tambah Expense'">
                                    </h3>
                                    <p class="text-sm text-gray-500 mt-1" x-text="transactionType === 'income' ? 'Catat pemasukan barumu' : 'Catat pengeluaran barumu'"></p>
                                    
                                    <div class="mt-5 sm:mt-8 space-y-4 sm:space-y-5 text-left">
                                        <!-- Amount -->
                                        <div>
                                            <label for="amount" class="block text-sm font-bold text-gray-700 mb-2 ml-1">Jumlah</label>
                                            <div class="relative">
                                                <div class="absolute inset-y-0 left-0 flex items-center pl-5 pointer-events-none">
                                                    <span class="text-gray-500 font-semibold text-base">Rp</span>
                                                </div>
                                                <input type="number" name="amount" id="amount" required min="1"
                                                       class="block w-full rounded-[1.25rem] bg-gray-50 border border-gray-200/80 py-3.5 pl-14 pr-5 text-gray-900 text-lg font-bold placeholder:text-gray-400 placeholder:font-medium hover:bg-gray-100/50 focus:bg-white focus:ring-4 focus:ring-[#FCE2CE]/50 focus:border-[#FCE2CE] transition-all shadow-sm [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none">
                                            </div>
                                        </div>

                                        <!-- Date & Category Grid -->
                                        <div class="grid grid-cols-2 gap-4">
                                            <!-- Date -->
                                            <div>
                                                <label for="date" class="block text-sm font-bold text-gray-700 mb-2 ml-1">Tanggal</label>
                                                <input type="date" name="date" id="date" required value="{{ date('Y-m-d') }}"
                                                       class="block w-full rounded-[1.25rem] bg-gray-50 border border-gray-200/80 py-3 px-4 text-gray-900 text-sm font-semibold hover:bg-gray-100/50 focus:bg-white focus:ring-4 focus:ring-[#FCE2CE]/50 focus:border-[#FCE2CE] transition-all shadow-sm cursor-pointer">
                                            </div>

                                            <!-- Category -->
                                            <div class="relative">
                                                <label for="category" class="block text-sm font-bold text-gray-700 mb-2 ml-1">Kategori</label>
                                                <select name="category_id" id="category" required
                                                        class="block w-full rounded-[1.25rem] bg-gray-50 border border-gray-200/80 py-3 px-4 text-gray-900 text-sm font-semibold hover:bg-gray-100/50 focus:bg-white focus:ring-4 focus:ring-[#FCE2CE]/50 focus:border-[#FCE2CE] transition-all shadow-sm cursor-pointer outline-none appearance-none pr-10 relative">
                                                    <option value="" disabled selected>Pilih...</option>
                                                    <!-- Income Categories (Dynamic) -->
                                                    <template x-if="transactionType === 'income'">
                                                        <optgroup label="Income">
                                                            @isset($globalIncomeCategories)
                                                                @foreach($globalIncomeCategories as $cat)
                                                                    <option value="{{ $cat->id }}">{{ $cat->icon }} {{ $cat->name }}</option>
                                                                @endforeach
                                                            @endisset
                                                        </optgroup>
                                                    </template>
                                                    <!-- Expense Categories (Dynamic) -->
                                                    <template x-if="transactionType === 'expense'">
                                                        <optgroup label="Expense">
                                                            @isset($globalExpenseCategories)
                                                                @foreach($globalExpenseCategories as $cat)
                                                                    <option value="{{ $cat->id }}">{{ $cat->icon }} {{ $cat->name }}</option>
                                                                @endforeach
                                                            @endisset
                                                        </optgroup>
                                                    </template>
                                                </select>
                                                <!-- Custom Chevron -->
                                                <div class="pointer-events-none absolute inset-y-0 right-0 top-7 flex items-center px-4 text-gray-500">
                                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- Description -->
                                        <div>
                                            <label for="description" class="block text-sm font-bold text-gray-700 mb-2 ml-1">Deskripsi <span class="text-xs font-normal text-gray-400 ml-1">(Opsional)</span></label>
                                            <input type="text" name="description" id="description" placeholder="Untuk keperluan apa?"
                                                   class="block w-full rounded-[1.25rem] bg-gray-50 border border-gray-200/80 py-3.5 px-5 text-gray-900 text-sm font-medium placeholder:text-gray-400 hover:bg-gray-100/50 focus:bg-white focus:ring-4 focus:ring-[#FCE2CE]/50 focus:border-[#FCE2CE] transition-all shadow-sm">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50/80 px-5 py-4 sm:px-8 sm:py-6 sm:flex sm:flex-row-reverse border-t border-gray-100/80">
                            <button type="submit" 
                                    class="inline-flex w-full justify-center items-center gap-2 rounded-2xl bg-[#3E2723] px-8 py-3.5 text-sm font-bold text-white shadow-lg shadow-[#3E2723]/20 hover:bg-[#2A1A18] hover:-translate-y-0.5 sm:ml-3 sm:w-auto transition-all focus:ring-4 focus:ring-[#FCE2CE]/80"
                                    x-text="transactionType === 'income' ? 'Simpan Income' : 'Simpan Expense'">
                            </button>
                            <button type="button" @click="transactionModalOpen = false"
                                    class="mt-3 inline-flex w-full justify-center items-center rounded-2xl bg-white px-8 py-3.5 text-sm font-bold text-gray-700 shadow-sm border border-gray-200 hover:bg-gray-50 hover:text-gray-900 sm:mt-0 sm:w-auto transition-all">
                                Batal
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- ==================================================================== -->
    <!-- TODO MODAL -->
    <!-- ==================================================================== -->
    <div x-show="todoModalOpen" style="display: none;" class="relative z-[100]" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <!-- Background backdrop -->
        <div x-show="todoModalOpen"
             x-transition:enter="ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm transition-opacity"></div>

        <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
            <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
                <!-- Modal panel -->
                <div x-show="todoModalOpen"
                     @click.away="todoModalOpen = false"
                     x-transition:enter="ease-out duration-300"
                     x-transition:enter-start="opacity-0 translate-y-8 sm:translate-y-0 sm:scale-95"
                     x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave="ease-in duration-200"
                     x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave-end="opacity-0 translate-y-8 sm:translate-y-0 sm:scale-95"
                     class="relative transform overflow-hidden rounded-[2rem] bg-white text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-[480px] border border-white/60">
                    
                    <form action="{{ route('todo.store') }}" method="POST">
                        @csrf
                        
                        <div class="bg-white px-5 pb-5 pt-6 sm:px-8 sm:pb-8 sm:pt-8 relative">
                            <!-- Close Button -->
                            <button type="button" @click="todoModalOpen = false" class="absolute top-6 right-6 p-2 rounded-full text-gray-400 hover:bg-gray-100 hover:text-gray-600 transition-colors">
                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>

                            <div class="sm:flex sm:items-center sm:flex-col">
                                <!-- Modal Header icon -->
                                <div class="mx-auto flex h-12 w-12 sm:h-16 sm:w-16 flex-shrink-0 items-center justify-center rounded-2xl sm:rounded-3xl bg-gradient-to-br from-[#FCE2CE] to-[#F5D0B0] text-[#5F402D] sm:mx-0 shadow-sm">
                                    <svg class="h-6 w-6 sm:h-8 sm:w-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                                    </svg>
                                </div>
                                <div class="mt-3 sm:mt-5 text-center w-full">
                                    <h3 class="text-lg sm:text-2xl font-extrabold text-[#3E2723] tracking-tight" id="modal-title" style="font-family: 'Poppins', sans-serif;">
                                        Tambah Tugas Baru
                                    </h3>
                                    <p class="text-sm text-gray-500 mt-1">Apa yang ingin kamu capai?</p>
                                    
                                    <div class="mt-5 sm:mt-8 space-y-4 sm:space-y-5 text-left">
                                        <!-- Title -->
                                        <div>
                                            <label for="title" class="block text-sm font-bold text-gray-700 mb-2 ml-1">Judul Tugas</label>
                                            <input type="text" name="title" id="title" required placeholder="Contoh: Kerjakan tugas presentasi"
                                                   class="block w-full rounded-[1.25rem] bg-gray-50 border border-gray-200/80 py-3.5 px-5 text-gray-900 text-sm font-medium placeholder:text-gray-400 hover:bg-gray-100/50 focus:bg-white focus:ring-4 focus:ring-[#FCE2CE]/50 focus:border-[#FCE2CE] transition-all shadow-sm">
                                        </div>

                                        <div class="grid grid-cols-2 gap-4">
                                            <!-- Priority -->
                                            <div class="relative">
                                                <label for="priority" class="block text-sm font-bold text-gray-700 mb-2 ml-1">Prioritas</label>
                                                <select name="priority" id="priority" required
                                                        class="block w-full rounded-[1.25rem] bg-gray-50 border border-gray-200/80 py-3 px-4 text-gray-900 text-sm font-semibold hover:bg-gray-100/50 focus:bg-white focus:ring-4 focus:ring-[#FCE2CE]/50 focus:border-[#FCE2CE] transition-all shadow-sm cursor-pointer outline-none appearance-none pr-10 relative">
                                                    <option value="low">Low</option>
                                                    <option value="medium" selected>Medium</option>
                                                    <option value="high">High</option>
                                                </select>
                                                <!-- Custom Chevron -->
                                                <div class="pointer-events-none absolute inset-y-0 right-0 top-7 flex items-center px-4 text-gray-500 w-1/2 justify-end">
                                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                                </div>
                                            </div>
                                            
                                            <!-- Due Date -->
                                            <div>
                                                <label for="due_date" class="block text-sm font-bold text-gray-700 mb-2 ml-1">Tenggat <span class="text-xs font-normal text-gray-400 ml-0.5">(Ops)</span></label>
                                                <input type="date" name="due_date" id="due_date"
                                                       class="block w-full rounded-[1.25rem] bg-gray-50 border border-gray-200/80 py-3 px-4 text-gray-900 text-sm font-semibold placeholder:text-gray-400 hover:bg-gray-100/50 focus:bg-white focus:ring-4 focus:ring-[#FCE2CE]/50 focus:border-[#FCE2CE] transition-all shadow-sm cursor-pointer">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50/80 px-5 py-4 sm:px-8 sm:py-6 sm:flex sm:flex-row-reverse border-t border-gray-100/80">
                            <button type="submit" 
                                    class="inline-flex w-full justify-center items-center gap-2 rounded-2xl bg-[#3E2723] px-8 py-3.5 text-sm font-bold text-white shadow-lg shadow-[#3E2723]/20 hover:bg-[#2A1A18] hover:-translate-y-0.5 sm:ml-3 sm:w-auto transition-all focus:ring-4 focus:ring-[#FCE2CE]/80">
                                Simpan Tugas
                            </button>
                            <button type="button" @click="todoModalOpen = false"
                                    class="mt-3 inline-flex w-full justify-center items-center rounded-2xl bg-white px-8 py-3.5 text-sm font-bold text-gray-700 shadow-sm border border-gray-200 hover:bg-gray-50 hover:text-gray-900 sm:mt-0 sm:w-auto transition-all">
                                Batal
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- ==================================================================== -->
    <!-- EDIT TODO MODAL -->
    <!-- ==================================================================== -->
    <div x-show="editTodoModalOpen" style="display: none;" class="relative z-[100]" aria-labelledby="edit-todo-modal-title" role="dialog" aria-modal="true">
        <!-- Background backdrop -->
        <div x-show="editTodoModalOpen"
             x-transition:enter="ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm transition-opacity"></div>

        <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
            <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
                <!-- Modal panel -->
                <div x-show="editTodoModalOpen"
                     @click.away="editTodoModalOpen = false"
                     x-transition:enter="ease-out duration-300"
                     x-transition:enter-start="opacity-0 translate-y-8 sm:translate-y-0 sm:scale-95"
                     x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave="ease-in duration-200"
                     x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave-end="opacity-0 translate-y-8 sm:translate-y-0 sm:scale-95"
                     class="relative transform overflow-hidden rounded-[2rem] bg-white text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-[480px] border border-white/60">

                    <form :action="'/todo/' + editTodoId" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="bg-white px-5 pb-5 pt-6 sm:px-8 sm:pb-8 sm:pt-8 relative">
                            <!-- Close Button -->
                            <button type="button" @click="editTodoModalOpen = false" class="absolute top-6 right-6 p-2 rounded-full text-gray-400 hover:bg-gray-100 hover:text-gray-600 transition-colors">
                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>

                            <div class="sm:flex sm:items-center sm:flex-col">
                                <!-- Modal Header icon -->
                                <div class="mx-auto flex h-12 w-12 sm:h-16 sm:w-16 flex-shrink-0 items-center justify-center rounded-2xl sm:rounded-3xl bg-gradient-to-br from-amber-100 to-amber-50 text-amber-600 sm:mx-0 shadow-sm">
                                    <svg class="h-6 w-6 sm:h-8 sm:w-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                    </svg>
                                </div>
                                <div class="mt-3 sm:mt-5 text-center w-full">
                                    <h3 class="text-lg sm:text-2xl font-extrabold text-[#3E2723] tracking-tight" id="edit-todo-modal-title" style="font-family: 'Poppins', sans-serif;">
                                        Edit Tugas
                                    </h3>
                                    <p class="text-sm text-gray-500 mt-1">Perbarui detail tugasmu</p>

                                    <div class="mt-5 sm:mt-8 space-y-4 sm:space-y-5 text-left">
                                        <!-- Title -->
                                        <div>
                                            <label for="edit_title" class="block text-sm font-bold text-gray-700 mb-2 ml-1">Judul Tugas</label>
                                            <input type="text" name="title" id="edit_title" required
                                                   :value="editTodoTitle"
                                                   class="block w-full rounded-[1.25rem] bg-gray-50 border border-gray-200/80 py-3.5 px-5 text-gray-900 text-sm font-medium placeholder:text-gray-400 hover:bg-gray-100/50 focus:bg-white focus:ring-4 focus:ring-[#FCE2CE]/50 focus:border-[#FCE2CE] transition-all shadow-sm">
                                        </div>

                                        <div class="grid grid-cols-2 gap-4">
                                            <!-- Priority -->
                                            <div class="relative">
                                                <label for="edit_priority" class="block text-sm font-bold text-gray-700 mb-2 ml-1">Prioritas</label>
                                                <select name="priority" id="edit_priority" required
                                                        x-model="editTodoPriority"
                                                        class="block w-full rounded-[1.25rem] bg-gray-50 border border-gray-200/80 py-3 px-4 text-gray-900 text-sm font-semibold hover:bg-gray-100/50 focus:bg-white focus:ring-4 focus:ring-[#FCE2CE]/50 focus:border-[#FCE2CE] transition-all shadow-sm cursor-pointer outline-none appearance-none pr-10 relative">
                                                    <option value="low">Low</option>
                                                    <option value="medium">Medium</option>
                                                    <option value="high">High</option>
                                                </select>
                                                <div class="pointer-events-none absolute inset-y-0 right-0 top-7 flex items-center px-4 text-gray-500 w-1/2 justify-end">
                                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                                </div>
                                            </div>

                                            <!-- Due Date -->
                                            <div>
                                                <label for="edit_due_date" class="block text-sm font-bold text-gray-700 mb-2 ml-1">Tenggat <span class="text-xs font-normal text-gray-400 ml-0.5">(Ops)</span></label>
                                                <input type="date" name="due_date" id="edit_due_date"
                                                       :value="editTodoDueDate"
                                                       class="block w-full rounded-[1.25rem] bg-gray-50 border border-gray-200/80 py-3 px-4 text-gray-900 text-sm font-semibold placeholder:text-gray-400 hover:bg-gray-100/50 focus:bg-white focus:ring-4 focus:ring-[#FCE2CE]/50 focus:border-[#FCE2CE] transition-all shadow-sm cursor-pointer">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50/80 px-5 py-4 sm:px-8 sm:py-6 sm:flex sm:flex-row-reverse border-t border-gray-100/80">
                            <button type="submit"
                                    class="inline-flex w-full justify-center items-center gap-2 rounded-2xl bg-[#3E2723] px-8 py-3.5 text-sm font-bold text-white shadow-lg shadow-[#3E2723]/20 hover:bg-[#2A1A18] hover:-translate-y-0.5 sm:ml-3 sm:w-auto transition-all focus:ring-4 focus:ring-[#FCE2CE]/80">
                                Perbarui Tugas
                            </button>
                            <button type="button" @click="editTodoModalOpen = false"
                                    class="mt-3 inline-flex w-full justify-center items-center rounded-2xl bg-white px-8 py-3.5 text-sm font-bold text-gray-700 shadow-sm border border-gray-200 hover:bg-gray-50 hover:text-gray-900 sm:mt-0 sm:w-auto transition-all">
                                Batal
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- ==================================================================== -->
    <!-- DELETE TASK CONFIRMATION MODAL -->
    <!-- ==================================================================== -->
    <div x-show="deleteModalOpen" style="display: none;" class="relative z-[100]" aria-labelledby="delete-modal-title" role="dialog" aria-modal="true">
        <!-- Background backdrop -->
        <div x-show="deleteModalOpen"
             x-transition:enter="ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm transition-opacity"></div>

        <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
            <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
                <!-- Modal panel -->
                <div x-show="deleteModalOpen"
                     @click.away="deleteModalOpen = false"
                     x-transition:enter="ease-out duration-300"
                     x-transition:enter-start="opacity-0 translate-y-8 sm:translate-y-0 sm:scale-95"
                     x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave="ease-in duration-200"
                     x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave-end="opacity-0 translate-y-8 sm:translate-y-0 sm:scale-95"
                     class="relative transform overflow-hidden rounded-[2rem] bg-white text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-[400px] border border-white/60">

                    <div class="bg-white px-5 pb-4 pt-6 sm:px-8 sm:pb-6 sm:pt-8">
                        <div class="flex flex-col items-center text-center">
                            <!-- Red Trash Icon -->
                            <div class="flex h-12 w-12 sm:h-16 sm:w-16 flex-shrink-0 items-center justify-center rounded-xl sm:rounded-2xl bg-red-50 mb-3 sm:mb-5">
                                <svg class="h-6 w-6 sm:h-8 sm:w-8 text-red-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                </svg>
                            </div>
                            <!-- Title -->
                            <h3 class="text-xl font-bold text-[#3E2723]" id="delete-modal-title" style="font-family: 'Poppins', sans-serif;">
                                Hapus Tugas
                            </h3>
                            <!-- Description -->
                            <p class="text-sm text-gray-500 mt-2 leading-relaxed">
                                Apakah kamu yakin ingin menghapus tugas ini? Tindakan ini tidak dapat dibatalkan.
                            </p>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="px-5 pb-5 pt-3 sm:px-8 sm:pb-8 sm:pt-4 flex items-center justify-center gap-3">
                        <button type="button" @click="deleteModalOpen = false"
                                class="flex-1 inline-flex justify-center items-center rounded-2xl bg-gray-100 px-6 py-3 text-sm font-bold text-gray-600 hover:bg-gray-200 transition-all">
                            Batal
                        </button>
                        <form :action="taskToDeleteUrl" method="POST" class="flex-1">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="w-full inline-flex justify-center items-center rounded-2xl bg-red-500 px-6 py-3 text-sm font-bold text-white hover:bg-red-600 shadow-sm hover:shadow-md transition-all">
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Alpine.js (for dropdown interactivity) -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>
</html>
