<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? config('app.name', 'LinkBayar') . ' - Solusi Pembayaran Digital' }}</title>
    @if(isset($metaDescription))
    <meta name="description" content="{{ $metaDescription }}">
    @endif

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @stack('fonts')

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        body {
            font-family: 'Outfit', sans-serif;
            scroll-behavior: smooth;
        }

        .glass {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .dark .glass {
            background: rgba(17, 24, 39, 0.7);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .animate-gradient {
            background-size: 200% 200%;
            animation: gradient 8s ease infinite;
        }

        @keyframes gradient {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .hero-shape {
            position: absolute;
            z-index: -1;
            filter: blur(80px);
            opacity: 0.5;
        }
    </style>
    @stack('styles')
</head>
<body class="bg-slate-50 dark:bg-gray-950 text-gray-900 dark:text-gray-100 transition-colors duration-300" x-data="{ mobileMenuOpen: false }">

    <!-- Navbar -->
    <nav class="fixed top-0 w-full z-50 glass shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <div class="flex items-center">
                    <a href="{{ route('home') }}">
                        <img src="{{ asset('image/logo.webp') }}" alt="Linkbayar Logo" class="h-36 w-auto -my-6">
                    </a>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center gap-8">
                    <a href="{{ route('home') }}" class="text-sm font-semibold hover:text-blue-600 transition-colors {{ request()->routeIs('home') ? 'text-blue-600' : '' }}">Beranda</a>
                    <a href="{{ route('biaya') }}" class="text-sm font-semibold hover:text-blue-600 transition-colors {{ request()->routeIs('biaya') ? 'text-blue-600' : '' }}">Biaya</a>
                    <a href="{{ route('panduan') }}" class="text-sm font-semibold hover:text-blue-600 transition-colors {{ request()->routeIs('panduan') ? 'text-blue-600' : '' }}">Panduan API</a>

                    @if (Route::has('login'))
                        <div class="flex items-center gap-4">
                            @auth
                                <a href="{{ url('/dashboard') }}" class="px-6 py-2.5 bg-blue-600 text-white rounded-xl font-bold text-sm shadow-lg shadow-blue-500/20 hover:bg-blue-700 transition-all active:scale-95">Dashboard</a>
                            @else
                                <a href="{{ route('login') }}" class="text-sm font-semibold hover:text-blue-600 transition-colors">Masuk</a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="px-6 py-2.5 bg-gray-900 dark:bg-white dark:text-gray-900 text-white rounded-xl font-bold text-sm hover:opacity-90 transition-all active:scale-95">Daftar Sekarang</a>
                                @endif
                            @endauth
                        </div>
                    @endif
                </div>

                <!-- Mobile Button -->
                <div class="md:hidden flex items-center">
                    <button @click="mobileMenuOpen = !mobileMenuOpen" class="p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">
                        <svg x-show="!mobileMenuOpen" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                        </svg>
                        <svg x-show="mobileMenuOpen" x-cloak xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Mobile Menu Dropdown -->
            <div x-show="mobileMenuOpen" x-cloak
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 -translate-y-2"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-2"
                 @click.away="mobileMenuOpen = false"
                 class="md:hidden pb-4 border-t border-gray-100 dark:border-gray-800">
                <div class="pt-4 space-y-1">
                    <a href="{{ route('home') }}" class="block px-4 py-3 rounded-xl text-sm font-semibold transition-colors {{ request()->routeIs('home') ? 'bg-blue-50 dark:bg-blue-900/20 text-blue-600' : 'hover:bg-gray-50 dark:hover:bg-gray-800' }}">
                        Beranda
                    </a>
                    <a href="{{ route('biaya') }}" class="block px-4 py-3 rounded-xl text-sm font-semibold transition-colors {{ request()->routeIs('biaya') ? 'bg-blue-50 dark:bg-blue-900/20 text-blue-600' : 'hover:bg-gray-50 dark:hover:bg-gray-800' }}">
                        Biaya
                    </a>
                    <a href="{{ route('panduan') }}" class="block px-4 py-3 rounded-xl text-sm font-semibold transition-colors {{ request()->routeIs('panduan') ? 'bg-blue-50 dark:bg-blue-900/20 text-blue-600' : 'hover:bg-gray-50 dark:hover:bg-gray-800' }}">
                        Panduan API
                    </a>
                    @if (Route::has('login'))
                        <div class="pt-3 mt-3 border-t border-gray-100 dark:border-gray-800 space-y-1">
                            @auth
                                <a href="{{ url('/dashboard') }}" class="block px-4 py-3 rounded-xl bg-blue-600 text-white font-bold text-sm text-center">
                                    Dashboard
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="block px-4 py-3 rounded-xl text-sm font-semibold hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors">
                                    Masuk
                                </a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="block px-4 py-3 rounded-xl bg-gray-900 dark:bg-white dark:text-gray-900 text-white font-bold text-sm text-center">
                                        Daftar Sekarang
                                    </a>
                                @endif
                            @endauth
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- Page Content -->
    {{ $slot }}

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-400 py-12 border-t border-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-center gap-8">
                <div class="flex items-center">
                    <a href="{{ route('home') }}">
                        <img src="{{ asset('image/logo.webp') }}" alt="Linkbayar Logo" class="h-36 w-auto -my-6">
                    </a>
                </div>

                <div class="flex flex-wrap items-center justify-center gap-6 md:gap-8 text-sm">
                    <a href="{{ route('home') }}" class="hover:text-white transition-colors">Beranda</a>
                    <a href="{{ route('biaya') }}" class="hover:text-white transition-colors">Biaya</a>
                    <a href="{{ route('panduan') }}" class="hover:text-white transition-colors">Panduan</a>
                    @if (Route::has('login'))
                        <a href="{{ route('login') }}" class="hover:text-white transition-colors">Login</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="hover:text-white transition-colors">Register</a>
                        @endif
                    @endif
                </div>

                <div class="text-xs text-center md:text-right">
                    &copy; {{ date('Y') }} Linkbayar Indonesia. All rights reserved.
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth' });
                }
            });
        });
    </script>
    @stack('scripts')
</body>
</html>
