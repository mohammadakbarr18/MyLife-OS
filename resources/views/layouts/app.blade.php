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
<body class="bg-[#FEF6EF] font-sans text-[#424242] antialiased overflow-x-hidden">

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
                <a href="{{ route('todos') }}"
                   class="sidebar-link group flex items-center gap-3.5 px-4 py-3 rounded-2xl text-sm font-semibold transition-all duration-200
                          {{ request()->routeIs('todos*') ? 'bg-[#FCE2CE] text-[#5F402D] shadow-sm' : 'text-gray-500 hover:bg-[#FEF6EF] hover:text-[#5F402D]' }}">
                    <svg class="w-5 h-5 transition-colors {{ request()->routeIs('todos*') ? 'text-[#5F402D]' : 'text-gray-400 group-hover:text-[#5F402D]' }}" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
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
            <header class="hidden lg:block sticky top-0 z-30 bg-[#FEF6EF]/80 backdrop-blur-lg">
                <div class="flex items-center justify-between px-8 py-5">
                    <div>
                        <h1 class="text-xl font-bold text-[#3E2723]" style="font-family: 'Poppins', sans-serif;">
                            @yield('page-title', 'Dashboard')
                        </h1>
                        <p class="text-sm text-gray-400 mt-0.5">@yield('page-subtitle', 'Welcome back, ' . (Auth::user()->name ?? 'User') . '!')</p>
                    </div>
                    <div class="flex items-center gap-4">
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
            <main class="flex-1 px-5 py-6 lg:px-8 lg:py-2 pb-28 lg:pb-8">
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
            <a href="{{ route('todos') }}"
               class="flex flex-col items-center gap-1 py-1.5 px-3 rounded-2xl transition-all duration-200
                      {{ request()->routeIs('todos*') ? 'text-[#5F402D]' : 'text-gray-400' }}">
                <div class="p-1.5 rounded-xl transition-colors {{ request()->routeIs('todos*') ? 'bg-[#FCE2CE]' : '' }}">
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

    <!-- Alpine.js (for dropdown interactivity) -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>
</html>
