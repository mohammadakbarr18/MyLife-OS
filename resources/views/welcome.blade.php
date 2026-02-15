<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MyLife OS — Organize Your Life, Effortlessly</title>
    <meta name="description" content="MyLife OS is your personal operating system for clarity. Organize tasks, track habits, and achieve your goals — all in one beautiful place.">

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
                        <span class="text-xs font-semibold text-[#3E2723] tracking-wide uppercase">Your Personal OS</span>
                    </div>

                    <!-- H1 Headline -->
                    <h1 class="animate-fade-up-delay text-4xl sm:text-5xl lg:text-6xl xl:text-7xl font-extrabold text-[#3E2723] leading-tight tracking-tight" style="font-family: 'Poppins', sans-serif;">
                        Organize Your Life,
                        <span class="relative inline-block">
                            <span class="relative z-10">Effortlessly.</span>
                            <span class="absolute bottom-1 left-0 w-full h-3 lg:h-4 bg-[#FCE2CE]/60 rounded-full -z-0"></span>
                        </span>
                    </h1>

                    <!-- Sub-headline -->
                    <p class="animate-fade-up-delay-2 mt-5 lg:mt-6 text-base sm:text-lg lg:text-xl text-[#5F402D]/80 max-w-lg mx-auto lg:mx-0 leading-relaxed">
                        The all-in-one personal dashboard to track your tasks, habits, and goals — designed for clarity, built for focus.
                    </p>

                    <!-- CTA Buttons -->
                    <div class="animate-fade-up-delay-3 mt-8 lg:mt-10 flex flex-col sm:flex-row items-center gap-4 justify-center lg:justify-start">
                        <!-- Primary CTA -->
                        <a href="{{ route('register') }}" id="cta-register"
                           class="group inline-flex items-center gap-2 bg-[#FCE2CE] text-[#3E2723] font-bold text-base px-8 py-4 rounded-full shadow-lg hover:shadow-xl hover:bg-[#fdd5b8] transition-all duration-300 transform hover:scale-[1.03] active:scale-[0.98]">
                            Get Started
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
                            Sign In
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
            <span class="text-xs font-medium tracking-widest uppercase">Discover</span>
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
                <span class="inline-block text-xs font-bold tracking-widest uppercase text-[#5F402D]/60 mb-3">Why MyLife OS?</span>
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-[#3E2723] leading-tight" style="font-family: 'Poppins', sans-serif;">
                    Everything you need,<br class="hidden sm:block"> nothing you don't.
                </h2>
            </div>

            <!-- Feature Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-8">

                <!-- Feature 1: Organize -->
                <div class="group bg-white rounded-3xl p-8 lg:p-10 shadow-sm hover:shadow-lg border border-[#FCE2CE]/30 hover:border-[#FCE2CE] transition-all duration-300 hover:-translate-y-1">
                    <div class="w-14 h-14 bg-[#FCE2CE]/40 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-[#FCE2CE]/60 transition-colors duration-300">
                        <svg class="w-7 h-7 text-[#3E2723]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 12h16.5m-16.5 3.75h16.5M3.75 19.5h16.5M5.625 4.5h12.75a1.875 1.875 0 010 3.75H5.625a1.875 1.875 0 010-3.75z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-[#3E2723] mb-3" style="font-family: 'Poppins', sans-serif;">Organize</h3>
                    <p class="text-[#5F402D]/70 leading-relaxed">
                        Keep your tasks, notes, and priorities perfectly sorted. A clean workspace for a clear mind.
                    </p>
                </div>

                <!-- Feature 2: Track -->
                <div class="group bg-white rounded-3xl p-8 lg:p-10 shadow-sm hover:shadow-lg border border-[#FCE2CE]/30 hover:border-[#FCE2CE] transition-all duration-300 hover:-translate-y-1">
                    <div class="w-14 h-14 bg-[#FCE2CE]/40 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-[#FCE2CE]/60 transition-colors duration-300">
                        <svg class="w-7 h-7 text-[#3E2723]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-[#3E2723] mb-3" style="font-family: 'Poppins', sans-serif;">Track</h3>
                    <p class="text-[#5F402D]/70 leading-relaxed">
                        Monitor your progress with beautiful insights. See your habits, goals, and finances at a glance.
                    </p>
                </div>

                <!-- Feature 3: Achieve -->
                <div class="group bg-white rounded-3xl p-8 lg:p-10 shadow-sm hover:shadow-lg border border-[#FCE2CE]/30 hover:border-[#FCE2CE] transition-all duration-300 hover:-translate-y-1">
                    <div class="w-14 h-14 bg-[#FCE2CE]/40 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-[#FCE2CE]/60 transition-colors duration-300">
                        <svg class="w-7 h-7 text-[#3E2723]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0l-4.725 2.885a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-[#3E2723] mb-3" style="font-family: 'Poppins', sans-serif;">Achieve</h3>
                    <p class="text-[#5F402D]/70 leading-relaxed">
                        Turn your ambitions into reality. Stay consistent, stay motivated, and celebrate every win.
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
                <a href="{{ route('login') }}" class="text-sm text-[#3E2723]/50 hover:text-[#3E2723] font-medium transition-colors">Sign In</a>
                <a href="{{ route('register') }}" class="text-sm text-[#3E2723]/50 hover:text-[#3E2723] font-medium transition-colors">Create Account</a>
            </div>
        </div>
    </footer>

</body>
</html>
