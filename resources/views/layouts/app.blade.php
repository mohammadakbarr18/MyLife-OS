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
      x-data="{ transactionModalOpen: false, transactionType: 'income', todoModalOpen: false }">

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
                                Profile
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 text-sm text-red-500 hover:bg-red-50 transition-colors">
                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                    </svg>
                                    Log Out
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
                        <p class="text-base font-medium text-gray-500 mt-1">@yield('page-subtitle', 'Welcome back, ' . (Auth::user()->name ?? 'User') . '!')</p>
                    </div>

                    {{-- Right Side: Date Widget & Notification --}}
                    <div class="flex items-center gap-3">
                        {{-- Date Pill Widget --}}
                        <div class="bg-white px-4 py-2 rounded-full shadow-sm text-sm font-medium text-[#5F402D] border border-gray-100 flex items-center gap-2">
                            <svg class="w-4 h-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                            </svg>
                            {{ now()->translatedFormat('D, d M Y') }}
                        </div>

                        <!-- Notification Bell -->
                        <button class="w-10 h-10 rounded-2xl bg-white flex items-center justify-center shadow-sm hover:shadow-md transition-shadow border border-gray-100">
                            <svg class="w-5 h-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                        </button>
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
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
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
                        
                        <div class="bg-white px-8 pb-8 pt-8 relative">
                            <!-- Close Button -->
                            <button type="button" @click="transactionModalOpen = false" class="absolute top-6 right-6 p-2 rounded-full text-gray-400 hover:bg-gray-100 hover:text-gray-600 transition-colors">
                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>

                            <div class="sm:flex sm:items-center sm:flex-col">
                                <!-- Modal Header icon -->
                                <div class="mx-auto flex h-16 w-16 flex-shrink-0 items-center justify-center rounded-3xl transition-colors duration-300 shadow-sm"
                                     :class="transactionType === 'income' ? 'bg-gradient-to-br from-emerald-100 to-emerald-50 text-emerald-600' : 'bg-gradient-to-br from-red-100 to-red-50 text-red-600'">
                                    <svg class="h-8 w-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div class="mt-5 text-center w-full">
                                    <h3 class="text-2xl font-extrabold text-[#3E2723] tracking-tight" id="modal-title" style="font-family: 'Poppins', sans-serif;" 
                                        x-text="transactionType === 'income' ? 'Add Income' : 'Add Expense'">
                                    </h3>
                                    <p class="text-sm text-gray-500 mt-1" x-text="transactionType === 'income' ? 'Record your new earnings' : 'Record a new spending'"></p>
                                    
                                    <div class="mt-8 space-y-5 text-left">
                                        <!-- Amount -->
                                        <div>
                                            <label for="amount" class="block text-sm font-bold text-gray-700 mb-2 ml-1">Amount</label>
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
                                                <label for="date" class="block text-sm font-bold text-gray-700 mb-2 ml-1">Date</label>
                                                <input type="date" name="date" id="date" required value="{{ date('Y-m-d') }}"
                                                       class="block w-full rounded-[1.25rem] bg-gray-50 border border-gray-200/80 py-3 px-4 text-gray-900 text-sm font-semibold hover:bg-gray-100/50 focus:bg-white focus:ring-4 focus:ring-[#FCE2CE]/50 focus:border-[#FCE2CE] transition-all shadow-sm cursor-pointer">
                                            </div>

                                            <!-- Category -->
                                            <div class="relative">
                                                <label for="category" class="block text-sm font-bold text-gray-700 mb-2 ml-1">Category</label>
                                                <select name="category_id" id="category" required
                                                        class="block w-full rounded-[1.25rem] bg-gray-50 border border-gray-200/80 py-3 px-4 text-gray-900 text-sm font-semibold hover:bg-gray-100/50 focus:bg-white focus:ring-4 focus:ring-[#FCE2CE]/50 focus:border-[#FCE2CE] transition-all shadow-sm cursor-pointer outline-none appearance-none pr-10 relative">
                                                    <option value="" disabled selected>Select...</option>
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
                                            <label for="description" class="block text-sm font-bold text-gray-700 mb-2 ml-1">Description <span class="text-xs font-normal text-gray-400 ml-1">(Optional)</span></label>
                                            <input type="text" name="description" id="description" placeholder="What is this for?"
                                                   class="block w-full rounded-[1.25rem] bg-gray-50 border border-gray-200/80 py-3.5 px-5 text-gray-900 text-sm font-medium placeholder:text-gray-400 hover:bg-gray-100/50 focus:bg-white focus:ring-4 focus:ring-[#FCE2CE]/50 focus:border-[#FCE2CE] transition-all shadow-sm">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50/80 px-8 py-6 sm:flex sm:flex-row-reverse sm:px-8 border-t border-gray-100/80">
                            <button type="submit" 
                                    class="inline-flex w-full justify-center items-center gap-2 rounded-2xl bg-[#3E2723] px-8 py-3.5 text-sm font-bold text-white shadow-lg shadow-[#3E2723]/20 hover:bg-[#2A1A18] hover:-translate-y-0.5 sm:ml-3 sm:w-auto transition-all focus:ring-4 focus:ring-[#FCE2CE]/80"
                                    x-text="transactionType === 'income' ? 'Save Income' : 'Save Expense'">
                            </button>
                            <button type="button" @click="transactionModalOpen = false"
                                    class="mt-3 inline-flex w-full justify-center items-center rounded-2xl bg-white px-8 py-3.5 text-sm font-bold text-gray-700 shadow-sm border border-gray-200 hover:bg-gray-50 hover:text-gray-900 sm:mt-0 sm:w-auto transition-all">
                                Cancel
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
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
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
                        
                        <div class="bg-white px-8 pb-8 pt-8 relative">
                            <!-- Close Button -->
                            <button type="button" @click="todoModalOpen = false" class="absolute top-6 right-6 p-2 rounded-full text-gray-400 hover:bg-gray-100 hover:text-gray-600 transition-colors">
                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>

                            <div class="sm:flex sm:items-center sm:flex-col">
                                <!-- Modal Header icon -->
                                <div class="mx-auto flex h-16 w-16 flex-shrink-0 items-center justify-center rounded-3xl bg-gradient-to-br from-[#FCE2CE] to-[#F5D0B0] text-[#5F402D] sm:mx-0 shadow-sm">
                                    <svg class="h-8 w-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                                    </svg>
                                </div>
                                <div class="mt-5 text-center w-full">
                                    <h3 class="text-2xl font-extrabold text-[#3E2723] tracking-tight" id="modal-title" style="font-family: 'Poppins', sans-serif;">
                                        Add New Task
                                    </h3>
                                    <p class="text-sm text-gray-500 mt-1">What do you want to achieve?</p>
                                    
                                    <div class="mt-8 space-y-5 text-left">
                                        <!-- Title -->
                                        <div>
                                            <label for="title" class="block text-sm font-bold text-gray-700 mb-2 ml-1">Task Title</label>
                                            <input type="text" name="title" id="title" required placeholder="E.g., Finish project presentation"
                                                   class="block w-full rounded-[1.25rem] bg-gray-50 border border-gray-200/80 py-3.5 px-5 text-gray-900 text-sm font-medium placeholder:text-gray-400 hover:bg-gray-100/50 focus:bg-white focus:ring-4 focus:ring-[#FCE2CE]/50 focus:border-[#FCE2CE] transition-all shadow-sm">
                                        </div>

                                        <div class="grid grid-cols-2 gap-4">
                                            <!-- Priority -->
                                            <div class="relative">
                                                <label for="priority" class="block text-sm font-bold text-gray-700 mb-2 ml-1">Priority</label>
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
                                                <label for="due_date" class="block text-sm font-bold text-gray-700 mb-2 ml-1">Due Date <span class="text-xs font-normal text-gray-400 ml-0.5">(Opt)</span></label>
                                                <input type="date" name="due_date" id="due_date"
                                                       class="block w-full rounded-[1.25rem] bg-gray-50 border border-gray-200/80 py-3 px-4 text-gray-900 text-sm font-semibold placeholder:text-gray-400 hover:bg-gray-100/50 focus:bg-white focus:ring-4 focus:ring-[#FCE2CE]/50 focus:border-[#FCE2CE] transition-all shadow-sm cursor-pointer">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50/80 px-8 py-6 sm:flex sm:flex-row-reverse sm:px-8 border-t border-gray-100/80">
                            <button type="submit" 
                                    class="inline-flex w-full justify-center items-center gap-2 rounded-2xl bg-[#3E2723] px-8 py-3.5 text-sm font-bold text-white shadow-lg shadow-[#3E2723]/20 hover:bg-[#2A1A18] hover:-translate-y-0.5 sm:ml-3 sm:w-auto transition-all focus:ring-4 focus:ring-[#FCE2CE]/80">
                                Save Task
                            </button>
                            <button type="button" @click="todoModalOpen = false"
                                    class="mt-3 inline-flex w-full justify-center items-center rounded-2xl bg-white px-8 py-3.5 text-sm font-bold text-gray-700 shadow-sm border border-gray-200 hover:bg-gray-50 hover:text-gray-900 sm:mt-0 sm:w-auto transition-all">
                                Cancel
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Alpine.js (for dropdown interactivity) -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>
</html>
