<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dokumentasi API - LinkBayar Indonesia</title>
    <meta name="description" content="Dokumentasi lengkap API LinkBayar untuk integrasi pembayaran QRIS, Virtual Account, dan Checkout Page ke website atau aplikasi Anda.">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500;600;700&display=swap" rel="stylesheet">

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

        .code-font {
            font-family: 'JetBrains Mono', monospace;
        }

        /* Sidebar active indicator */
        .sidebar-link.active {
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.1), rgba(99, 102, 241, 0.1));
            border-left-color: #3b82f6;
            color: #3b82f6;
            font-weight: 700;
        }

        .sidebar-link {
            border-left: 3px solid transparent;
            transition: all 0.2s ease;
        }

        .sidebar-link:hover {
            background: rgba(59, 130, 246, 0.05);
            border-left-color: rgba(59, 130, 246, 0.3);
        }

        /* Code block styling */
        .code-block {
            position: relative;
        }

        .code-block::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            border-radius: 8px 8px 0 0;
            background: linear-gradient(90deg, #3b82f6, #8b5cf6, #06b6d4);
        }

        /* Copy button animation */
        .copy-btn {
            opacity: 0;
            transition: opacity 0.2s;
        }

        .code-block:hover .copy-btn {
            opacity: 1;
        }

        /* Scroll spy smooth highlight */
        .doc-section {
            scroll-margin-top: 100px;
        }
    </style>
</head>
<body class="bg-slate-50 dark:bg-gray-950 text-gray-900 dark:text-gray-100 transition-colors duration-300">

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
                    <a href="{{ route('home') }}" class="text-sm font-semibold hover:text-blue-600 transition-colors">Beranda</a>
                    <a href="{{ route('biaya') }}" class="text-sm font-semibold hover:text-blue-600 transition-colors">Biaya</a>
                    <a href="{{ route('panduan') }}" class="text-sm font-semibold text-blue-600 transition-colors">Panduan API</a>
                    
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
                <div class="md:hidden flex items-center" x-data="{ mobileOpen: false }">
                    <button @click="mobileOpen = !mobileOpen" class="p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                        </svg>
                    </button>
                    <!-- Mobile Menu Dropdown -->
                    <div x-show="mobileOpen" @click.away="mobileOpen = false" x-transition
                         class="absolute top-20 right-4 w-64 bg-white dark:bg-gray-800 rounded-2xl shadow-2xl border border-gray-100 dark:border-gray-700 p-4 space-y-2">
                        <a href="{{ route('home') }}" class="block px-4 py-3 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-700 font-semibold text-sm transition-colors">Beranda</a>
                        <a href="{{ route('biaya') }}" class="block px-4 py-3 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-700 font-semibold text-sm transition-colors">Biaya</a>
                        <a href="{{ route('panduan') }}" class="block px-4 py-3 rounded-xl bg-blue-50 dark:bg-blue-900/20 text-blue-600 font-bold text-sm">Panduan API</a>
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/dashboard') }}" class="block px-4 py-3 rounded-xl bg-blue-600 text-white font-bold text-sm text-center">Dashboard</a>
                            @else
                                <a href="{{ route('login') }}" class="block px-4 py-3 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-700 font-semibold text-sm transition-colors">Masuk</a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="block px-4 py-3 rounded-xl bg-gray-900 dark:bg-white dark:text-gray-900 text-white font-bold text-sm text-center">Daftar</a>
                                @endif
                            @endauth
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Header -->
    <section class="relative pt-32 pb-16 lg:pt-44 lg:pb-20 overflow-hidden">
        <div class="hero-shape top-0 left-0 w-96 h-96 bg-blue-400"></div>
        <div class="hero-shape bottom-0 right-0 w-96 h-96 bg-purple-400"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400 text-xs font-bold mb-6">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                </svg>
                Dokumentasi Lengkap
            </div>
            <h1 class="text-4xl lg:text-6xl font-extrabold tracking-tight mb-6 leading-tight">
                📚 Dokumentasi API <br>
                <span class="bg-clip-text text-transparent bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 animate-gradient">LinkBayar</span>
            </h1>
            <p class="text-lg text-gray-600 dark:text-gray-400 max-w-2xl mx-auto mb-4 leading-relaxed">
                Integrasikan sistem pembayaran modern ke website atau aplikasi Anda dengan mudah menggunakan API kami.
            </p>
            <div class="flex items-center justify-center gap-3 text-sm text-gray-400">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Terakhir diperbarui: 17 Maret 2026
            </div>
        </div>
    </section>

    <!-- Quick Nav Cards -->
    <section class="pb-12">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-7 gap-3">
                <a href="#pendahuluan" class="p-4 bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all text-center group">
                    <div class="w-10 h-10 bg-blue-50 dark:bg-blue-900/30 rounded-xl flex items-center justify-center mx-auto mb-2 group-hover:bg-blue-600 group-hover:text-white transition-colors text-blue-600">
                        <span class="text-lg">1</span>
                    </div>
                    <span class="text-xs font-bold text-gray-600 dark:text-gray-400">Pendahuluan</span>
                </a>
                <a href="#persiapan" class="p-4 bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all text-center group">
                    <div class="w-10 h-10 bg-purple-50 dark:bg-purple-900/30 rounded-xl flex items-center justify-center mx-auto mb-2 group-hover:bg-purple-600 group-hover:text-white transition-colors text-purple-600">
                        <span class="text-lg">2</span>
                    </div>
                    <span class="text-xs font-bold text-gray-600 dark:text-gray-400">Persiapan</span>
                </a>
                <a href="#autentikasi" class="p-4 bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all text-center group">
                    <div class="w-10 h-10 bg-amber-50 dark:bg-amber-900/30 rounded-xl flex items-center justify-center mx-auto mb-2 group-hover:bg-amber-600 group-hover:text-white transition-colors text-amber-600">
                        <span class="text-lg">3</span>
                    </div>
                    <span class="text-xs font-bold text-gray-600 dark:text-gray-400">Autentikasi</span>
                </a>
                <a href="#daftar-api" class="p-4 bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all text-center group">
                    <div class="w-10 h-10 bg-emerald-50 dark:bg-emerald-900/30 rounded-xl flex items-center justify-center mx-auto mb-2 group-hover:bg-emerald-600 group-hover:text-white transition-colors text-emerald-600">
                        <span class="text-lg">4</span>
                    </div>
                    <span class="text-xs font-bold text-gray-600 dark:text-gray-400">Daftar API</span>
                </a>
                <a href="#webhook" class="p-4 bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all text-center group">
                    <div class="w-10 h-10 bg-red-50 dark:bg-red-900/30 rounded-xl flex items-center justify-center mx-auto mb-2 group-hover:bg-red-600 group-hover:text-white transition-colors text-red-600">
                        <span class="text-lg">5</span>
                    </div>
                    <span class="text-xs font-bold text-gray-600 dark:text-gray-400">Webhook</span>
                </a>
                <a href="#testing" class="p-4 bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all text-center group">
                    <div class="w-10 h-10 bg-indigo-50 dark:bg-indigo-900/30 rounded-xl flex items-center justify-center mx-auto mb-2 group-hover:bg-indigo-600 group-hover:text-white transition-colors text-indigo-600">
                        <span class="text-lg">6</span>
                    </div>
                    <span class="text-xs font-bold text-gray-600 dark:text-gray-400">Testing</span>
                </a>
                <a href="#bantuan" class="p-4 bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all text-center group">
                    <div class="w-10 h-10 bg-cyan-50 dark:bg-cyan-900/30 rounded-xl flex items-center justify-center mx-auto mb-2 group-hover:bg-cyan-600 group-hover:text-white transition-colors text-cyan-600">
                        <span class="text-lg">7</span>
                    </div>
                    <span class="text-xs font-bold text-gray-600 dark:text-gray-400">Bantuan</span>
                </a>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <section class="pb-24">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">

            <!-- ======================== -->
            <!-- 1. Pendahuluan -->
            <!-- ======================== -->
            <div id="pendahuluan" class="doc-section bg-white dark:bg-gray-800 rounded-3xl border border-gray-100 dark:border-gray-700 shadow-sm overflow-hidden">
                <div class="p-8 lg:p-10">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="p-3 bg-blue-100 dark:bg-blue-900/30 text-blue-600 rounded-2xl">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h2 class="text-2xl font-extrabold text-gray-900 dark:text-white">1. Pendahuluan</h2>
                    </div>
                    <div class="text-gray-600 dark:text-gray-400 space-y-4">
                        <p class="text-lg leading-relaxed">Dokumentasi ini ditujukan untuk merchant yang ingin mengintegrasikan sistem pembayaran <span class="font-bold text-blue-600">LinkBayar</span> ke dalam website atau aplikasi mereka.</p>
                        <p class="font-semibold text-gray-900 dark:text-white mt-6">Dengan API ini, Anda dapat:</p>
                        <div class="grid sm:grid-cols-2 gap-3 mt-4">
                            <div class="flex items-center gap-3 p-4 bg-blue-50 dark:bg-blue-900/10 rounded-2xl border border-blue-100 dark:border-blue-900/30">
                                <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                                </div>
                                <span class="text-sm font-medium">Membuat transaksi pembayaran (QRIS, dan Virtual Account)</span>
                            </div>
                            <div class="flex items-center gap-3 p-4 bg-emerald-50 dark:bg-emerald-900/10 rounded-2xl border border-emerald-100 dark:border-emerald-900/30">
                                <div class="w-8 h-8 bg-emerald-600 rounded-lg flex items-center justify-center shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                                </div>
                                <span class="text-sm font-medium">Menerima notifikasi otomatis saat pembayaran berhasil (Webhook)</span>
                            </div>
                            <div class="flex items-center gap-3 p-4 bg-purple-50 dark:bg-purple-900/10 rounded-2xl border border-purple-100 dark:border-purple-900/30">
                                <div class="w-8 h-8 bg-purple-600 rounded-lg flex items-center justify-center shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                                </div>
                                <span class="text-sm font-medium">Integrasi mudah dengan Checkout Page (<strong>Integrasi Via URL</strong>) dan Integrasi Via API</span>
                            </div>
                            <div class="flex items-center gap-3 p-4 bg-rose-50 dark:bg-rose-900/10 rounded-2xl border border-rose-100 dark:border-rose-900/30">
                                <div class="w-8 h-8 bg-rose-600 rounded-lg flex items-center justify-center shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                                </div>
                                <span class="text-sm font-medium">Membatalkan transaksi yang belum dibayar</span>
                            </div>
                            <div class="flex items-center gap-3 p-4 bg-amber-50 dark:bg-amber-900/10 rounded-2xl border border-amber-100 dark:border-amber-900/30 sm:col-span-2">
                                <div class="w-8 h-8 bg-amber-600 rounded-lg flex items-center justify-center shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                                </div>
                                <span class="text-sm font-medium">Mengecek status/detail transaksi</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ======================== -->
            <!-- 2. Persiapan -->
            <!-- ======================== -->
            <div id="persiapan" class="doc-section bg-white dark:bg-gray-800 rounded-3xl border border-gray-100 dark:border-gray-700 shadow-sm overflow-hidden">
                <div class="p-8 lg:p-10">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="p-3 bg-purple-100 dark:bg-purple-900/30 text-purple-600 rounded-2xl">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                            </svg>
                        </div>
                        <h2 class="text-2xl font-extrabold text-gray-900 dark:text-white">2. Persiapan</h2>
                    </div>
                    <div class="space-y-6">
                        <p class="text-gray-600 dark:text-gray-400">Sebelum mulai menggunakan API, pastikan Anda telah:</p>
                        <div class="bg-gray-50 dark:bg-gray-900/50 p-6 rounded-2xl border border-gray-100 dark:border-gray-700">
                            <ol class="space-y-4 list-none">
                                <li class="flex items-start gap-4">
                                    <span class="w-8 h-8 bg-blue-600 text-white rounded-lg flex items-center justify-center text-sm font-bold shrink-0 mt-0.5">1</span>
                                    <span class="text-gray-600 dark:text-gray-400">Mendaftar akun di dashboard <span class="font-bold text-blue-600">LinkBayar</span>.</span>
                                </li>
                                <li class="flex items-start gap-4">
                                    <span class="w-8 h-8 bg-blue-600 text-white rounded-lg flex items-center justify-center text-sm font-bold shrink-0 mt-0.5">2</span>
                                    <span class="text-gray-600 dark:text-gray-400">Membuat project baru.</span>
                                </li>
                                <li class="flex items-start gap-4">
                                    <span class="w-8 h-8 bg-blue-600 text-white rounded-lg flex items-center justify-center text-sm font-bold shrink-0 mt-0.5">3</span>
                                    <span class="text-gray-600 dark:text-gray-400">Mencatat <span class="text-blue-600 font-bold uppercase">API Key</span> dan <span class="text-blue-600 font-bold uppercase">Slug</span> dari halaman detail project.</span>
                                </li>
                                <li class="flex items-start gap-4">
                                    <span class="w-8 h-8 bg-blue-600 text-white rounded-lg flex items-center justify-center text-sm font-bold shrink-0 mt-0.5">4</span>
                                    <span class="text-gray-600 dark:text-gray-400">Mengatur <span class="text-blue-600 font-bold uppercase">Webhook URL</span> di pengaturan project.</span>
                                </li>
                            </ol>
                        </div>

                        <div class="p-4 bg-amber-50 dark:bg-amber-900/20 border border-amber-200 dark:border-amber-900/30 rounded-2xl">
                            <div class="flex items-center gap-2 text-amber-700 dark:text-amber-300 text-sm font-bold mb-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                Informasi Penting
                            </div>
                        </div>

                        <div class="grid md:grid-cols-3 gap-4">
                            <div class="p-5 bg-white dark:bg-gray-900/50 border border-gray-100 dark:border-gray-700 rounded-2xl hover:shadow-md transition-shadow">
                                <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">Base URL</span>
                                <div class="mt-2 code-font text-sm text-blue-600 font-semibold break-all">https://app.linkbayar.my.id</div>
                            </div>
                            <div class="p-5 bg-white dark:bg-gray-900/50 border border-gray-100 dark:border-gray-700 rounded-2xl hover:shadow-md transition-shadow">
                                <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">API Key</span>
                                <div class="mt-2 text-sm text-gray-600 dark:text-gray-400 italic">Tersedia di dashboard project.</div>
                            </div>
                            <div class="p-5 bg-white dark:bg-gray-900/50 border border-gray-100 dark:border-gray-700 rounded-2xl hover:shadow-md transition-shadow">
                                <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">Slug</span>
                                <div class="mt-2 text-sm text-gray-600 dark:text-gray-400 italic">Nama unik project Anda (digunakan untuk Via URL).</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ======================== -->
            <!-- 3. Autentikasi -->
            <!-- ======================== -->
            <div id="autentikasi" class="doc-section bg-white dark:bg-gray-800 rounded-3xl border border-gray-100 dark:border-gray-700 shadow-sm overflow-hidden">
                <div class="p-8 lg:p-10">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="p-3 bg-amber-100 dark:bg-amber-900/30 text-amber-600 rounded-2xl">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                            </svg>
                        </div>
                        <h2 class="text-2xl font-extrabold text-gray-900 dark:text-white">3. Autentikasi</h2>
                    </div>
                    <div class="space-y-6">
                        <p class="text-gray-600 dark:text-gray-400">Semua request API memerlukan API Key untuk autentikasi. Kirimkan melalui header:</p>
                        
                        <div class="code-block bg-gray-950 p-6 rounded-2xl overflow-auto">
                            <div class="code-font text-sm">
                                <span class="text-blue-400">X-API-Key:</span> <span class="text-emerald-400">api_key_anda</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ======================== -->
            <!-- 4. Daftar API -->
            <!-- ======================== -->
            <div id="daftar-api" class="doc-section bg-white dark:bg-gray-800 rounded-3xl border border-gray-100 dark:border-gray-700 shadow-sm overflow-hidden">
                <div class="p-8 lg:p-10">
                    <div class="flex items-center gap-4 mb-8">
                        <div class="p-3 bg-emerald-100 dark:bg-emerald-900/30 text-emerald-600 rounded-2xl">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l3 3-3 3m5 0h3M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <h2 class="text-2xl font-extrabold text-gray-900 dark:text-white">4. Daftar API</h2>
                    </div>
                    
                    <div class="space-y-12">

                        <!-- ===== A. Membuat Transaksi (Direct API) ===== -->
                        <div class="border-t border-gray-100 dark:border-gray-700 pt-8 first:border-0 first:pt-0">
                            <div class="flex flex-wrap items-center gap-3 mb-4">
                                <span class="px-3 py-1.5 bg-blue-100 text-blue-700 rounded-lg text-xs font-bold uppercase tracking-wider">POST</span>
                                <h3 class="text-xl font-bold text-gray-900 dark:text-white">A. Membuat Transaksi (Direct API)</h3>
                            </div>
                            <p class="text-gray-600 dark:text-gray-400 mb-6">Gunakan API ini jika Anda ingin membuat halaman checkout sendiri.</p>
                            
                            <div class="space-y-6">
                                <div class="code-block bg-gray-950 p-6 rounded-2xl overflow-auto">
                                    <div class="code-font text-xs text-gray-400 mb-2">// Method: POST</div>
                                    <div class="code-font text-sm text-emerald-400 break-all">https://app.linkbayar.my.id/api/transactioncreate/{method}</div>
                                </div>

                                <div class="code-block bg-gray-950 rounded-xl p-4 overflow-auto">
                                    <div class="code-font text-xs text-gray-400 mb-1">// Headers</div>
                                    <div class="code-font text-xs"><span class="text-blue-400">X-API-Key:</span> <span class="text-emerald-400">api_key_anda</span></div>
                                </div>

                                <div>
                                    <h4 class="font-bold text-gray-900 dark:text-white mb-3">Body (JSON)</h4>
                                    <div class="code-block bg-gray-950 p-6 rounded-2xl overflow-auto">
<pre class="code-font text-xs text-emerald-400">{
    "project": "nama_project_anda",
    "order_id": "INV123",
    "amount": 50000
}</pre>
                                    </div>
                                </div>

                                <div>
                                    <h4 class="font-bold text-gray-900 dark:text-white mb-3">Response Sukses</h4>
                                    <div class="code-block bg-gray-950 p-6 rounded-2xl overflow-auto">
<pre class="code-font text-xs text-emerald-400">{
    "payment": {
        "project": "nama_project_anda",
        "order_id": "INV123",
        "amount": 50000,
        "fee": 650,
        "total_payment": 50650,
        "payment_method": "qris",
        "payment_number": "00020101021126570022ID.CO...",
        "reference": "IP-SANDBOX-1773757421",
        "expired_at": "2026-03-18T21:23:41+07:00"
    }
}</pre>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- ===== B. Integrasi Via URL (Checkout Page) ===== -->
                        <div class="border-t border-gray-100 dark:border-gray-700 pt-8">
                            <div class="flex flex-wrap items-center gap-3 mb-4">
                                <span class="px-3 py-1.5 bg-emerald-100 text-emerald-700 rounded-lg text-xs font-bold uppercase tracking-wider">POST</span>
                                <h3 class="text-xl font-bold text-gray-900 dark:text-white">B. Integrasi Via URL (Checkout Page) 🚀</h3>
                            </div>
                            <p class="text-gray-600 dark:text-gray-400 mb-6">Metode ini paling aman dan profesional. URL yang dihasilkan sangat pendek dan parameter aslinya tersembunyi.</p>
                            
                            <div class="space-y-6">
                                <!-- Langkah 1 -->
                                <div class="bg-gradient-to-br from-gray-50 to-blue-50/30 dark:from-gray-900/50 dark:to-blue-900/10 p-6 lg:p-8 rounded-2xl border border-gray-100 dark:border-gray-700">
                                    <h4 class="font-bold text-gray-900 dark:text-white mb-4 flex items-center gap-3">
                                        <span class="w-8 h-8 bg-blue-600 text-white rounded-lg flex items-center justify-center text-sm font-bold shadow-lg shadow-blue-500/20">1</span>
                                        <span>Buat Sesi Pembayaran (Server-to-Server)</span>
                                    </h4>
                                    <p class="text-gray-600 dark:text-gray-400 mb-5 text-sm">Merchant memanggil API ini dari backend untuk mendapatkan token pembayaran.</p>
                                    
                                    <div class="space-y-4">
                                        <div class="code-block bg-gray-950 rounded-xl p-4 overflow-auto">
                                            <div class="code-font text-xs text-gray-400 mb-1">// Method: POST</div>
                                            <div class="code-font text-xs text-emerald-400 break-all">https://app.linkbayar.my.id/api/checkout-session</div>
                                        </div>
                                        <div class="code-block bg-gray-950 rounded-xl p-4 overflow-auto">
                                            <div class="code-font text-xs text-gray-400 mb-1">// Headers</div>
                                            <div class="code-font text-xs"><span class="text-blue-400">X-API-Key:</span> <span class="text-emerald-400">api_key_anda</span></div>
                                        </div>
                                        <div>
                                            <div class="text-xs font-bold text-gray-900 dark:text-white mb-2">Body (JSON):</div>
                                            <div class="code-block bg-gray-950 p-4 rounded-xl overflow-auto">
<pre class="code-font text-xs text-emerald-400">{
    "amount": 50000,
    "order_id": "INV-123",
    "redirect_url": "https://tokoanda.com/success"
}</pre>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="text-xs font-bold text-gray-900 dark:text-white mb-2">Response Sukses:</div>
                                            <div class="code-block bg-gray-950 p-4 rounded-xl overflow-auto">
<pre class="code-font text-xs text-emerald-400">{
    "payment_url": "https://app.linkbayar.my.id/pay/tokoonline/e8ff1622749f6a48...",
    "order_id": "INV-123",
    "amount": 50000
}</pre>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Langkah 2 -->
                                <div class="bg-gradient-to-br from-gray-50 to-indigo-50/30 dark:from-gray-900/50 dark:to-indigo-900/10 p-6 lg:p-8 rounded-2xl border border-gray-100 dark:border-gray-700">
                                    <h4 class="font-bold text-gray-900 dark:text-white mb-4 flex items-center gap-3">
                                        <span class="w-8 h-8 bg-blue-600 text-white rounded-lg flex items-center justify-center text-sm font-bold shadow-lg shadow-blue-500/20">2</span>
                                        <span>Arahkan Pelanggan</span>
                                    </h4>
                                    <p class="text-gray-600 dark:text-gray-400 text-sm">Cukup arahkan pelanggan ke <code class="bg-gray-200 dark:bg-gray-700 px-2 py-1 rounded-lg text-blue-600 text-xs code-font">payment_url</code> yang Anda dapatkan dari Langkah 1. URL ini berlaku selama <span class="font-bold text-blue-600">1 jam</span>.</p>
                                </div>

                                <!-- Keuntungan -->
                                <div class="p-5 bg-emerald-50 dark:bg-emerald-900/20 border border-emerald-200 dark:border-emerald-900/30 rounded-2xl">
                                    <p class="font-bold text-emerald-700 dark:text-emerald-300 mb-3 flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                        Keuntungan:
                                    </p>
                                    <ul class="space-y-2 text-sm text-emerald-700 dark:text-emerald-300">
                                        <li class="flex items-start gap-2"><span>✅</span><span>URL sangat bersih dan pendek.</span></li>
                                        <li class="flex items-start gap-2"><span>✅</span><span>Nominal dan Order ID tidak bisa diubah oleh user.</span></li>
                                        <li class="flex items-start gap-2"><span>✅</span><span>Parameter sensitif tidak terlihat di browser.</span></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- ===== C. Cek Status/Detail Transaksi ===== -->
                        <div class="border-t border-gray-100 dark:border-gray-700 pt-8">
                            <div class="flex flex-wrap items-center gap-3 mb-4">
                                <span class="px-3 py-1.5 bg-amber-100 text-amber-700 rounded-lg text-xs font-bold uppercase tracking-wider">GET</span>
                                <h3 class="text-xl font-bold text-gray-900 dark:text-white">C. Cek Status/Detail Transaksi</h3>
                            </div>
                            <p class="text-gray-600 dark:text-gray-400 mb-6">Gunakan API ini untuk mendapatkan detail lengkap transaksi.</p>
                            
                            <div class="space-y-4">
                                <div class="code-block bg-gray-950 rounded-2xl p-6 overflow-auto">
                                    <div class="code-font text-xs text-gray-400 mb-1">// Method: GET</div>
                                    <div class="code-font text-sm text-emerald-400 break-all">https://app.linkbayar.my.id/api/transactiondetail?order_id=INV-123</div>
                                </div>
                                <div class="code-block bg-gray-950 rounded-xl p-4 overflow-auto">
                                    <div class="code-font text-xs text-gray-400 mb-1">// Headers</div>
                                    <div class="code-font text-xs"><span class="text-blue-400">X-API-Key:</span> <span class="text-emerald-400">api_key_anda</span></div>
                                </div>

                                <div>
                                    <h4 class="font-bold text-gray-900 dark:text-white mb-3">Response Sukses</h4>
                                    <div class="code-block bg-gray-950 p-6 rounded-2xl overflow-auto">
<pre class="code-font text-xs text-emerald-400">{
    "transaction": {
        "amount": 50000,
        "fee": 650,
        "total_payment": 50650,
        "order_id": "INV123",
        "project": "nama_project_anda",
        "status": "pending",
        "payment_method": "qris",
        "completed_at": "0001-01-01T00:00:00Z"
    }
}</pre>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- ===== D. Batalkan Transaksi ===== -->
                        <div class="border-t border-gray-100 dark:border-gray-700 pt-8">
                            <div class="flex flex-wrap items-center gap-3 mb-4">
                                <span class="px-3 py-1.5 bg-rose-100 text-rose-700 rounded-lg text-xs font-bold uppercase tracking-wider">POST</span>
                                <h3 class="text-xl font-bold text-gray-900 dark:text-white">D. Batalkan Transaksi</h3>
                            </div>
                            <p class="text-gray-600 dark:text-gray-400 mb-6">Membatalkan transaksi yang masih berstatus <code class="bg-rose-100 dark:bg-rose-900/30 px-2 py-1 rounded-lg text-rose-600 text-xs code-font font-bold">pending</code>.</p>
                            
                            <div class="space-y-6">
                                <div class="code-block bg-gray-950 rounded-2xl p-6 overflow-auto">
                                    <div class="code-font text-xs text-gray-400 mb-1">// Method: POST</div>
                                    <div class="code-font text-sm text-emerald-400 break-all">https://app.linkbayar.my.id/api/transactioncancel</div>
                                </div>
                                <div class="code-block bg-gray-950 rounded-xl p-4 overflow-auto">
                                    <div class="code-font text-xs text-gray-400 mb-1">// Headers</div>
                                    <div class="code-font text-xs"><span class="text-blue-400">X-API-Key:</span> <span class="text-emerald-400">api_key_anda</span></div>
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-900 dark:text-white mb-3">Body (JSON)</h4>
                                    <div class="code-block bg-gray-950 p-6 rounded-2xl overflow-auto">
<pre class="code-font text-xs text-emerald-400">{
    "project": "nama_project_anda",
    "order_id": "INV-123",
    "amount": 50000
}</pre>
                                    </div>
                                </div>

                                <div>
                                    <h4 class="font-bold text-gray-900 dark:text-white mb-3">Response Sukses</h4>
                                    <div class="code-block bg-gray-950 p-6 rounded-2xl overflow-auto">
<pre class="code-font text-xs text-emerald-400">{
    "message": "Transaction cancelled"
}</pre>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ======================== -->
            <!-- 5. Webhook -->
            <!-- ======================== -->
            <div id="webhook" class="doc-section bg-white dark:bg-gray-800 rounded-3xl border border-gray-100 dark:border-gray-700 shadow-sm overflow-hidden">
                <div class="p-8 lg:p-10">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="p-3 bg-red-100 dark:bg-red-900/30 text-red-600 rounded-2xl">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                            </svg>
                        </div>
                        <h2 class="text-2xl font-extrabold text-gray-900 dark:text-white">5. Webhook (Notifikasi Otomatis)</h2>
                    </div>
                    
                    <div class="space-y-6">
                        <p class="text-gray-600 dark:text-gray-400 text-lg">Sistem kami akan mengirimkan <span class="font-bold text-red-600">POST</span> ke URL Webhook Anda saat status transaksi berubah (berhasil/expired/batal).</p>

                        <div>
                            <h4 class="font-bold text-gray-900 dark:text-white mb-3">Payload (JSON):</h4>
                            <div class="code-block bg-gray-950 p-6 rounded-2xl overflow-auto">
<pre class="code-font text-xs text-emerald-400">{
    "amount": 50000,
    "fee": 2500,
    "net_amount": 47500,
    "order_id": "ORD-001",
    "project": "tokoonline",
    "status": "success",
    "payment_method": "qris",
    "completed_at": "2026-03-17T14:40:00Z"
}</pre>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ======================== -->
            <!-- 6. Testing & Sandbox -->
            <!-- ======================== -->
            <div id="testing" class="doc-section bg-white dark:bg-gray-800 rounded-3xl border border-gray-100 dark:border-gray-700 shadow-sm overflow-hidden">
                <div class="p-8 lg:p-10">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="p-3 bg-indigo-100 dark:bg-indigo-900/30 text-indigo-600 rounded-2xl">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z" />
                            </svg>
                        </div>
                        <h2 class="text-2xl font-extrabold text-gray-900 dark:text-white">6. Testing & Sandbox</h2>
                    </div>
                    
                    <div class="space-y-6">
                        <p class="text-gray-600 dark:text-gray-400">Pastikan project Anda dalam mode <span class="font-bold text-indigo-600">Sandbox</span> saat melakukan pengujian. Anda dapat mensimulasikan pembayaran sukses melalui API simulation:</p>
                        
                        <div class="code-block bg-gray-950 rounded-2xl p-6 overflow-auto">
                            <div class="code-font text-xs text-gray-400 mb-1">// Method: POST</div>
                            <div class="code-font text-sm text-emerald-400 break-all">https://app.linkbayar.my.id/api/paymentsimulation</div>
                        </div>

                        <div class="code-block bg-gray-950 rounded-xl p-4 overflow-auto">
                            <div class="code-font text-xs text-gray-400 mb-1">// Headers</div>
                            <div class="code-font text-xs"><span class="text-blue-400">X-API-Key:</span> <span class="text-emerald-400">api_key_anda</span></div>
                        </div>

                        <div>
                            <h4 class="font-bold text-gray-900 dark:text-white mb-3">Body (JSON)</h4>
                            <div class="code-block bg-gray-950 p-6 rounded-2xl overflow-auto">
<pre class="code-font text-xs text-emerald-400">{
    "project": "nama_project_anda",
    "order_id": "INV123",
    "amount": 50000
}</pre>
                            </div>
                        </div>

                        <div>
                            <h4 class="font-bold text-gray-900 dark:text-white mb-3">Response Sukses</h4>
                            <div class="code-block bg-gray-950 p-6 rounded-2xl overflow-auto">
<pre class="code-font text-xs text-emerald-400">{
    "message": "Simulation successful for INV123",
    "status": "success"
}</pre>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ======================== -->
            <!-- 7. Bantuan -->
            <!-- ======================== -->
            <div id="bantuan" class="doc-section bg-gradient-to-br from-slate-900 to-blue-900 rounded-3xl overflow-hidden shadow-xl relative">
                <div class="hero-shape top-0 right-0 w-64 h-64 bg-blue-500/30"></div>
                <div class="p-8 lg:p-12 text-center relative z-10">
                    <div class="w-16 h-16 bg-white/10 rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-3">7. Bantuan</h3>
                    <p class="text-blue-200 mb-8 max-w-lg mx-auto">Jika ada kendala, hubungi tim teknis kami:</p>
                    <div class="flex flex-col sm:flex-row justify-center gap-4">
                        <a href="mailto:support@linkbayar.my.id" class="px-8 py-4 bg-white text-gray-900 rounded-2xl font-bold hover:bg-gray-100 transition-all shadow-xl hover:-translate-y-1 flex items-center justify-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                            support@linkbayar.my.id
                        </a>
                        <a href="https://app.linkbayar.my.id" class="px-8 py-4 bg-white/10 text-white border border-white/20 rounded-2xl font-bold hover:bg-white/20 transition-all flex items-center justify-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" /></svg>
                            linkbayar.my.id
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-400 py-12 border-t border-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row justify-between items-center gap-8">
            <div class="flex items-center">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('image/logo.webp') }}" alt="Linkbayar Logo" class="h-36 w-auto -my-6">
                </a>
            </div>
            
            <div class="flex items-center gap-8 text-sm">
                <a href="{{ route('home') }}" class="hover:text-white transition-colors">Beranda</a>
                <a href="{{ route('biaya') }}" class="hover:text-white transition-colors">Biaya</a>
                <a href="{{ route('panduan') }}" class="text-blue-400 hover:text-blue-300 transition-colors font-semibold">Panduan</a>
                @if (Route::has('login'))
                    <a href="{{ route('login') }}" class="hover:text-white transition-colors">Login</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="hover:text-white transition-colors">Register</a>
                    @endif
                @endif
            </div>

            <div class="text-xs">
                &copy; {{ date('Y') }} Linkbayar Indonesia. All rights reserved.
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
</body>
</html>
