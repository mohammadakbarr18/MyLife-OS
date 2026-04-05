<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MyLife OS — Sistem Operasi untuk Kehidupanmu</title>
    <meta name="description" content="MyLife OS adalah sistem operasi pribadi untuk mengelola seluruh kehidupan sehari-harimu — keuangan, tugas, jadwal, dan masih banyak lagi. Semua dalam satu tempat yang rapi dan elegan.">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Landing page animations */
        @keyframes fade-up {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes fade-in {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-16px); }
        }
        @keyframes blob-pulse {
            0%, 100% { transform: scale(1); opacity: 0.5; }
            50% { transform: scale(1.08); opacity: 0.7; }
        }
        .animate-fade-up { animation: fade-up 0.8s ease-out forwards; }
        .animate-fade-up-delay { animation: fade-up 0.8s ease-out 0.15s forwards; opacity: 0; }
        .animate-fade-up-delay-2 { animation: fade-up 0.8s ease-out 0.3s forwards; opacity: 0; }
        .animate-fade-up-delay-3 { animation: fade-up 0.8s ease-out 0.45s forwards; opacity: 0; }
        .animate-fade-in-slow { animation: fade-in 1.2s ease-out 0.3s forwards; opacity: 0; }
        .animate-float { animation: float 6s ease-in-out infinite; }
        .animate-blob { animation: blob-pulse 8s ease-in-out infinite; }
    </style>
</head>
<body class="bg-[#FEF6EF] antialiased overflow-x-hidden" style="font-family: 'Inter', sans-serif;">

    <!-- ============================================================ -->
    <!-- HERO SECTION                                                  -->
    <!-- ============================================================ -->
    <section class="relative min-h-screen flex items-center overflow-hidden">

        <!-- Subtle background decorations -->
        <div class="absolute top-[-10%] right-[-5%] w-[500px] h-[500px] bg-[#FCE2CE] rounded-full opacity-20 blur-3xl animate-blob"></div>
        <div class="absolute bottom-[-15%] left-[-10%] w-[400px] h-[400px] bg-[#FCE2CE] rounded-full opacity-15 blur-3xl animate-blob" style="animation-delay: 4s;"></div>

        <div class="w-full max-w-7xl mx-auto px-6 sm:px-8 lg:px-12 py-12 lg:py-0">
            <div class="flex flex-col-reverse lg:flex-row items-center gap-8 lg:gap-16">

                <!-- ===== TEXT CONTENT (Left on desktop) ===== -->
                <div class="flex-1 text-center lg:text-left">

                    <!-- Badge -->
                    <div class="animate-fade-up inline-flex items-center gap-2 bg-white/70 backdrop-blur-sm border border-[#FCE2CE] rounded-full px-4 py-1.5 mb-6 shadow-sm">
                        <span class="w-2 h-2 bg-[#FCE2CE] rounded-full"></span>
                        <span class="text-xs font-semibold text-[#3E2723] tracking-wide uppercase">Your Life, One System</span>
                    </div>

                    <!-- H1 Headline -->
                    <h1 class="animate-fade-up-delay text-4xl sm:text-5xl lg:text-6xl xl:text-7xl font-extrabold text-[#3E2723] leading-tight tracking-tight" style="font-family: 'Poppins', sans-serif;">
                        Hidupmu, Satu
                        <span class="relative inline-block">
                            <span class="relative z-10">Kendali.</span>
                            <span class="absolute bottom-1 left-0 w-full h-3 lg:h-4 bg-[#FCE2CE]/60 rounded-full -z-0"></span>
                        </span>
                    </h1>

                    <!-- Sub-headline -->
                    <p class="animate-fade-up-delay-2 mt-5 lg:mt-6 text-base sm:text-lg lg:text-xl text-[#5F402D]/80 max-w-lg mx-auto lg:mx-0 leading-relaxed">
                        Kelola keuangan, tugas harian, jadwal, dan seluruh aspek kehidupanmu dari satu tempat. Simpel, terstruktur, dan terus berkembang.
                    </p>

                    <!-- CTA Buttons -->
                    <div class="animate-fade-up-delay-3 mt-8 lg:mt-10 flex flex-col sm:flex-row items-center gap-4 justify-center lg:justify-start">
                        <!-- Primary CTA -->
                        <a href="{{ route('register') }}" id="cta-register"
                           class="group inline-flex items-center gap-2 bg-[#FCE2CE] text-[#3E2723] font-bold text-base px-8 py-4 rounded-full shadow-lg hover:shadow-xl hover:bg-[#fdd5b8] transition-all duration-300 transform hover:scale-[1.03] active:scale-[0.98]">
                            Mulai Sekarang
                            <svg class="w-5 h-5 transition-transform duration-300 group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                            </svg>
                        </a>

                        <!-- Secondary CTA -->
                        <a href="{{ route('login') }}" id="cta-login"
                           class="inline-flex items-center gap-2 text-[#3E2723] font-semibold text-base px-8 py-4 rounded-full border-2 border-[#3E2723]/15 hover:border-[#3E2723]/40 hover:bg-white/50 transition-all duration-300">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
                            </svg>
                            Masuk
                        </a>
                    </div>
                </div>

                <!-- ===== HERO IMAGE (Right on desktop, Top on mobile) ===== -->
                <div class="flex-1 flex items-center justify-center relative animate-fade-in-slow">

                    <!-- Decorative Peach Arch (Desktop) -->
                    <div class="hidden lg:block absolute bottom-[-5%] w-[85%] h-[90%] bg-[#FCE2CE]/50 rounded-t-full z-0"></div>
                    <!-- Decorative Peach Circle (Mobile) -->
                    <div class="lg:hidden absolute w-64 h-64 sm:w-72 sm:h-72 bg-[#FCE2CE]/40 rounded-full z-0"></div>

                    <!-- Floating decorative dots -->
                    <div class="hidden lg:block absolute top-[10%] right-[5%] w-4 h-4 bg-[#FCE2CE] rounded-full opacity-70 animate-float" style="animation-delay: 1s;"></div>
                    <div class="hidden lg:block absolute bottom-[25%] left-[5%] w-3 h-3 bg-[#3E2723]/20 rounded-full animate-float" style="animation-delay: 2.5s;"></div>
                    <div class="hidden lg:block absolute top-[30%] left-[10%] w-2 h-2 bg-[#FCE2CE] rounded-full opacity-60 animate-float" style="animation-delay: 4s;"></div>

                    <!-- Hero Image -->
                    <img src="{{ asset('assets/login-illustration.svg') }}"
                         class="relative z-10 w-52 sm:w-64 md:w-72 lg:w-[400px] mx-auto object-contain drop-shadow-xl animate-float"
                         alt="MyLife OS Hero Illustration">
                </div>
            </div>
        </div>

        <!-- Scroll indicator -->
        <div class="hidden lg:flex absolute bottom-8 left-1/2 -translate-x-1/2 flex-col items-center gap-2 text-[#3E2723]/30 animate-fade-up-delay-3">
            <span class="text-xs font-medium tracking-widest uppercase">Jelajahi</span>
            <svg class="w-5 h-5 animate-bounce" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 13.5L12 21m0 0l-7.5-7.5M12 21V3" />
            </svg>
        </div>
    </section>

    <!-- ============================================================ -->
    <!-- FEATURES SECTION                                              -->
    <!-- ============================================================ -->
    <section class="relative py-20 lg:py-28 bg-white/40">
        <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-12">

            <!-- Section Header -->
            <div class="text-center mb-14 lg:mb-20">
                <span class="inline-block text-xs font-bold tracking-widest uppercase text-[#5F402D]/60 mb-3">Apa yang Bisa Dilakukan?</span>
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-[#3E2723] leading-tight" style="font-family: 'Poppins', sans-serif;">
                    Bukan sekadar aplikasi,<br class="hidden sm:block"> ini sistem hidup teraturmu.
                </h2>
            </div>

            <!-- Feature Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 lg:gap-8">

                <!-- Feature 1: Kelola Keuangan -->
                <div class="group bg-white rounded-3xl p-8 lg:p-10 shadow-sm hover:shadow-lg border border-[#FCE2CE]/30 hover:border-[#FCE2CE] transition-all duration-300 hover:-translate-y-1">
                    <div class="w-14 h-14 bg-[#FCE2CE]/40 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-[#FCE2CE]/60 transition-colors duration-300">
                        <svg class="w-7 h-7 text-[#3E2723]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-[#3E2723] mb-3" style="font-family: 'Poppins', sans-serif;">Kelola Keuangan</h3>
                    <p class="text-[#5F402D]/70 leading-relaxed">
                        Catat pemasukan dan pengeluaran, buat kategori sendiri, dan pantau ringkasan keuanganmu secara berkala.
                    </p>
                </div>

                <!-- Feature 2: To-Do List -->
                <div class="group bg-white rounded-3xl p-8 lg:p-10 shadow-sm hover:shadow-lg border border-[#FCE2CE]/30 hover:border-[#FCE2CE] transition-all duration-300 hover:-translate-y-1">
                    <div class="w-14 h-14 bg-[#FCE2CE]/40 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-[#FCE2CE]/60 transition-colors duration-300">
                        <svg class="w-7 h-7 text-[#3E2723]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-[#3E2723] mb-3" style="font-family: 'Poppins', sans-serif;">Atur Aktivitas</h3>
                    <p class="text-[#5F402D]/70 leading-relaxed">
                        Buat to-do list, atur prioritas tugas, dan tandai selesai secara real-time agar hari-harimu lebih produktif.
                    </p>
                </div>

                <!-- Feature 3: Jadwal Harian (Daily Planner) — NEW -->
                <div class="group bg-white rounded-3xl p-8 lg:p-10 shadow-sm hover:shadow-lg border border-[#FCE2CE]/30 hover:border-[#FCE2CE] transition-all duration-300 hover:-translate-y-1">
                    <div class="w-14 h-14 bg-[#FCE2CE]/40 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-[#FCE2CE]/60 transition-colors duration-300">
                        <svg class="w-7 h-7 text-[#3E2723]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-[#3E2723] mb-3" style="font-family: 'Poppins', sans-serif;">Jadwal Harian</h3>
                    <p class="text-[#5F402D]/70 leading-relaxed">
                        Rencanakan hari dengan time-blocking. Navigasi antar tanggal, dan dukung jadwal lintas tengah malam.
                    </p>
                </div>

                <!-- Feature 4: Pantau Semuanya -->
                <div class="group bg-white rounded-3xl p-8 lg:p-10 shadow-sm hover:shadow-lg border border-[#FCE2CE]/30 hover:border-[#FCE2CE] transition-all duration-300 hover:-translate-y-1">
                    <div class="w-14 h-14 bg-[#FCE2CE]/40 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-[#FCE2CE]/60 transition-colors duration-300">
                        <svg class="w-7 h-7 text-[#3E2723]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3v11.25A2.25 2.25 0 006 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0118 16.5h-2.25m-7.5 0h7.5m-7.5 0l-1 3m8.5-3l1 3m0 0l.5 1.5m-.5-1.5h-9.5m0 0l-.5 1.5M9 11.25v1.5M12 9v3.75m3-6v6" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-[#3E2723] mb-3" style="font-family: 'Poppins', sans-serif;">Pantau Semuanya</h3>
                    <p class="text-[#5F402D]/70 leading-relaxed">
                        Lihat ringkasan seluruh hidupmu dari satu dashboard. Fitur terus bertambah sesuai kebutuhanmu.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- ============================================================ -->
    <!-- FOOTER                                                        -->
    <!-- ============================================================ -->
    <footer class="py-8 border-t border-[#FCE2CE]/40">
        <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-12 flex flex-col sm:flex-row items-center justify-between gap-4">
            <p class="text-sm text-[#3E2723]/40 font-medium">
                &copy; {{ date('Y') }} MyLife OS. Built with <span class="text-[#FCE2CE]">&hearts;</span> and vibe.
            </p>
            <div class="flex items-center gap-6">
                <a href="{{ route('login') }}" class="text-sm text-[#3E2723]/50 hover:text-[#3E2723] font-medium transition-colors">Masuk</a>
                <a href="{{ route('register') }}" class="text-sm text-[#3E2723]/50 hover:text-[#3E2723] font-medium transition-colors">Buat Akun</a>
            </div>
        </div>
    </footer>

</body>
</html>
