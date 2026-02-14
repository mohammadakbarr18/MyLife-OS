<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Log In - MyLife OS</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body class="bg-[#FEF6EF] font-sans text-[#424242] antialiased overflow-x-hidden">

    <div class="min-h-screen bg-[#FEF6EF] flex items-center justify-center p-6 lg:p-0">

        <div class="w-full max-w-md mx-auto lg:max-w-none lg:mx-0 lg:grid lg:grid-cols-2 lg:min-h-screen">

            <!-- ========== ILLUSTRATION COLUMN ========== -->
            <div class="order-1 lg:order-2 flex flex-col items-center justify-center relative py-8 lg:py-0 lg:min-h-screen lg:bg-[#FEF6EF] lg:overflow-hidden">

                <!-- Mobile/Tablet: Peach Circle (hidden on desktop) -->
                <div class="absolute bg-[#FCE2CE] rounded-full w-56 h-56 md:w-72 md:h-72 z-0 shadow-sm lg:hidden"></div>

                <!-- Desktop: Large Arch/Pill Shape (hidden on mobile/tablet) -->
                <div class="hidden lg:block absolute bottom-0 w-[70%] h-[85%] bg-[#FCE2CE] rounded-t-full z-0"></div>
                <div class="hidden lg:block absolute top-[20%] right-[20%] w-16 h-16 bg-[#FCE2CE] rounded-full blur-xl opacity-60"></div>
                <div class="hidden lg:block absolute bottom-[40%] left-[10%] w-20 h-20 bg-white rounded-full blur-2xl opacity-40"></div>

                <!-- 3D Character -->
                <img src="{{ asset('assets/login-illustration.svg') }}" 
                     class="relative z-10 w-52 md:w-64 lg:w-[350px] mx-auto object-contain drop-shadow-lg animate-float"
                     alt="Login Illustration">
            </div>

            <!-- ========== FORM COLUMN ========== -->
            <div class="order-2 lg:order-1 flex flex-col justify-center w-full max-w-md mx-auto lg:px-16 lg:py-12">
                
                <!-- Heading -->
                <h2 class="text-3xl md:text-4xl font-bold text-[#3E2723] text-center mb-1" style="font-family: 'Poppins', sans-serif;">
                    Welcome Back!!
                </h2>
                <p class="text-sm font-medium text-gray-400 text-center mb-6 hidden lg:block">
                    Log in to continue your journey
                </p>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4 text-center lg:text-left" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="space-y-5 lg:space-y-6">
                    @csrf

                    <!-- Email Address -->
                    <div class="space-y-1">
                        <label for="email" class="block text-xs font-semibold text-gray-500 ml-4">Email</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <input id="email" type="email" name="email" :value="old('email')" required autofocus
                                class="w-full pl-11 pr-4 py-3.5 rounded-3xl border border-gray-200 shadow-sm focus:border-[#FCE2CE] focus:ring-[#FCE2CE] bg-white transition-all outline-none placeholder-gray-400"
                                placeholder="email@gmail.com">
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2 ml-4" />
                    </div>

                    <!-- Password -->
                    <div class="space-y-1">
                        <label for="password" class="block text-xs font-semibold text-gray-500 ml-4">Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                            <input id="password" type="password" name="password" required
                                class="w-full pl-11 pr-12 py-3.5 rounded-3xl border border-gray-200 shadow-sm focus:border-[#FCE2CE] focus:ring-[#FCE2CE] bg-white transition-all outline-none placeholder-gray-400"
                                placeholder="Enter your password">
                            <button type="button" onclick="const p=document.getElementById('password');const show=this.querySelector('.eye-show');const hide=this.querySelector('.eye-hide');if(p.type==='password'){p.type='text';show.classList.add('hidden');hide.classList.remove('hidden')}else{p.type='password';show.classList.remove('hidden');hide.classList.add('hidden')}" class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-gray-500 transition-colors">
                                <!-- Eye icon (show password) -->
                                <svg class="h-5 w-5 eye-show" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                <!-- Eye-off icon (hide password) -->
                                <svg class="h-5 w-5 eye-hide hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                                </svg>
                            </button>
                        </div>
                        <div class="flex justify-end pt-1">
                            @if (Route::has('password.request'))
                                <a class="text-xs font-bold text-[#5F402D] hover:underline" href="{{ route('password.request') }}">
                                    Forgot Password?
                                </a>
                            @endif
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2 ml-4" />
                    </div>

                    <!-- Login Button -->
                    <button type="submit" 
                            class="w-full flex justify-center py-3.5 px-4 border border-transparent rounded-3xl shadow-lg text-base font-bold text-[#5F402D] bg-[#FCE2CE] hover:bg-[#ffdec0] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#FCE2CE] transition-all transform hover:scale-[1.01]">
                        Login
                    </button>

                    <!-- Separator -->
                    <div class="relative py-1">
                        <div class="relative flex justify-center">
                            <span class="px-2 text-xs text-gray-400 font-medium">- or -</span>
                        </div>
                    </div>

                    <!-- Social Login Icons -->
                    <div class="flex justify-center gap-6">
                        <button type="button" class="w-10 h-10 rounded-full bg-white border border-gray-100 shadow flex items-center justify-center hover:bg-gray-50 transition-colors">
                            <svg class="w-5 h-5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                                <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                                <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
                                <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
                            </svg>
                        </button>
                        <button type="button" class="w-10 h-10 rounded-full bg-white border border-gray-100 shadow flex items-center justify-center hover:bg-gray-50 transition-colors">
                            <svg class="w-6 h-6 text-[#1877F2]" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                            </svg>
                        </button>
                        <button type="button" class="w-10 h-10 rounded-full bg-white border border-gray-100 shadow flex items-center justify-center hover:bg-gray-50 transition-colors">
                            <svg class="w-5 h-5 text-black" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M17.05 20.28c-.98.95-2.05.8-3.08.35-1.09-.46-2.09-.48-3.24 0-1.44.62-2.2.44-3.06-.35C2.79 15.25 3.51 7.59 9.05 7.31c1.35.07 2.29.74 3.08.78.79.05 1.97-.68 3.28-.61 1.45.07 2.6.72 3.32 1.71-2.91 1.76-2.42 6.09.43 7.31-.62 1.55-1.46 3.06-2.11 3.78zm-4.71-15.01c.64-1.04 1.76-1.78 2.85-1.75.25 1.25-.32 2.53-1.02 3.4-1 .85-2.22 1.39-2.98 1.33-.08-1.28.51-2.49 1.15-2.98z"/>
                            </svg>
                        </button>
                    </div>

                    <p class="text-center text-xs font-semibold text-gray-400 mt-4">
                        Don't have an account? 
                        <a href="{{ route('register') }}" class="text-[#5F402D] hover:underline font-bold">Sign up</a>
                    </p>
                </form>
            </div>

        </div>
    </div>

</body>
</html>
