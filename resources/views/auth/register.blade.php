<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar - Sistem Pribadi</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body class="bg-[#FEF6EF] font-sans text-[#424242] antialiased overflow-x-hidden">

    <div class="min-h-screen bg-[#FEF6EF] flex items-center justify-center p-6 lg:p-0">

        <div class="w-full max-w-md mx-auto lg:max-w-none lg:mx-0 lg:grid lg:grid-cols-2 lg:min-h-screen">

            <!-- ========== ILLUSTRATION COLUMN ========== -->
            <div class="order-1 lg:order-1 flex flex-col items-center justify-center relative py-8 lg:py-0 lg:min-h-screen lg:bg-[#FEF6EF] lg:overflow-hidden">

                <!-- Mobile/Tablet: Peach Circle (hidden on desktop) -->
                <div class="absolute bg-[#FCE2CE] rounded-full w-56 h-56 md:w-72 md:h-72 z-0 shadow-sm lg:hidden"></div>

                <!-- Desktop: Large Arch/Pill Shape (hidden on mobile/tablet) -->
                <div class="hidden lg:block absolute bottom-0 w-[70%] h-[85%] bg-[#FCE2CE] rounded-t-full z-0"></div>
                <div class="hidden lg:block absolute top-[20%] left-[20%] w-16 h-16 bg-[#FCE2CE] rounded-full blur-xl opacity-60"></div>
                <div class="hidden lg:block absolute bottom-[30%] right-[10%] w-20 h-20 bg-white rounded-full blur-2xl opacity-40"></div>

                <!-- 3D Character -->
                <img src="{{ asset('assets/signup-illustration.svg') }}" 
                     class="relative z-10 w-72 md:w-90 lg:w-[500px] mx-auto object-contain drop-shadow-lg animate-float"
                     alt="Sign Up Illustration">
            </div>

            <!-- ========== FORM COLUMN ========== -->
            <div class="order-2 lg:order-2 flex flex-col justify-center w-full max-w-md mx-auto lg:px-8 xl:px-12 lg:py-12 lg:bg-[#FEF6EF]">
                
                <!-- Back to Landing Page -->
                <a href="{{ url('/') }}" class="inline-flex items-center gap-2 text-sm text-gray-500 hover:text-[#3E2723] transition-colors mb-6 group w-fit">
                    <svg class="w-4 h-4 transition-transform group-hover:-translate-x-0.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                    </svg>
                    Kembali ke Beranda
                </a>

                <!-- Heading -->
                <h2 class="text-2xl sm:text-3xl xl:text-4xl font-bold text-[#3E2723] text-center mb-1 whitespace-nowrap" style="font-family: 'Poppins', sans-serif;">
                    Buat Akun Baru
                </h2>
                <p class="text-sm font-medium text-gray-400 text-center mb-6">
                    Mulai perjalananmu bersama Sistem Pribadi
                </p>

                <form method="POST" action="{{ route('register') }}" class="space-y-5">
                    @csrf

                    <!-- Full Name -->
                    <div class="space-y-1">
                        <label for="name" class="block text-xs font-semibold text-gray-500 ml-4">Nama Lengkap</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <input id="name" type="text" name="name" :value="old('name')" required autofocus
                                   class="w-full pl-11 pr-4 py-3.5 rounded-3xl border border-gray-200 shadow-sm focus:border-[#FCE2CE] focus:ring-[#FCE2CE] bg-white transition-all outline-none placeholder-gray-400"
                                   placeholder="Nama lengkapmu">
                        </div>
                        <x-input-error :messages="$errors->get('name')" class="mt-2 ml-4" />
                    </div>

                    <!-- Email Address -->
                    <div class="space-y-1">
                        <label for="email" class="block text-xs font-semibold text-gray-500 ml-4">Alamat Email</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <input id="email" type="email" name="email" :value="old('email')" required
                                   class="w-full pl-11 pr-4 py-3.5 rounded-3xl border border-gray-200 shadow-sm focus:border-[#FCE2CE] focus:ring-[#FCE2CE] bg-white transition-all outline-none placeholder-gray-400"
                                   placeholder="email@gmail.com">
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2 ml-4" />
                    </div>

                    <!-- Password -->
                    <div class="space-y-1">
                        <label for="password" class="block text-xs font-semibold text-gray-500 ml-4">Kata Sandi</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                            <input id="password" type="password" name="password" required autocomplete="new-password"
                                   class="w-full pl-11 pr-12 py-3.5 rounded-3xl border border-gray-200 shadow-sm focus:border-[#FCE2CE] focus:ring-[#FCE2CE] bg-white transition-all outline-none placeholder-gray-400"
                                   placeholder="Masukkan kata sandimu">
                            <button type="button" onclick="const p=document.getElementById('password');const show=this.querySelector('.eye-show');const hide=this.querySelector('.eye-hide');if(p.type==='password'){p.type='text';show.classList.add('hidden');hide.classList.remove('hidden')}else{p.type='password';show.classList.remove('hidden');hide.classList.add('hidden')}" class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-gray-500 transition-colors">
                                <svg class="h-5 w-5 eye-show" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                <svg class="h-5 w-5 eye-hide hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                                </svg>
                            </button>
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2 ml-4" />
                    </div>

                    <!-- Confirm Password -->
                    <div class="space-y-1">
                        <label for="password_confirmation" class="block text-xs font-semibold text-gray-500 ml-4">Konfirmasi Kata Sandi</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                            <input id="password_confirmation" type="password" name="password_confirmation" required
                                   class="w-full pl-11 pr-12 py-3.5 rounded-3xl border border-gray-200 shadow-sm focus:border-[#FCE2CE] focus:ring-[#FCE2CE] bg-white transition-all outline-none placeholder-gray-400"
                                   placeholder="Ulangi kata sandimu">
                            <button type="button" onclick="const p=document.getElementById('password_confirmation');const show=this.querySelector('.eye-show');const hide=this.querySelector('.eye-hide');if(p.type==='password'){p.type='text';show.classList.add('hidden');hide.classList.remove('hidden')}else{p.type='password';show.classList.remove('hidden');hide.classList.add('hidden')}" class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-gray-500 transition-colors">
                                <svg class="h-5 w-5 eye-show" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                <svg class="h-5 w-5 eye-hide hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                                </svg>
                            </button>
                        </div>
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 ml-4" />
                    </div>

                    <!-- Sign Up Button -->
                    <button type="submit" 
                            class="w-full flex justify-center py-3.5 px-4 border border-transparent rounded-3xl shadow-lg text-base font-bold text-[#5F402D] bg-[#FCE2CE] hover:bg-[#ffdec0] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#FCE2CE] transition-all transform hover:scale-[1.01]">
                        Daftar
                    </button>

                    <p class="text-center text-xs font-semibold text-gray-400 mt-4">
                        Sudah punya akun? 
                        <a href="{{ route('login') }}" class="text-[#5F402D] hover:underline font-bold">Masuk di sini</a>
                    </p>
                </form>
            </div>

        </div>
    </div>

</body>
</html>
