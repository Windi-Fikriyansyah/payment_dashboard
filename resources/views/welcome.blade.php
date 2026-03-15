<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Link Pembayaran - Solusi Pembayaran Digital Tercepat</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

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

        .floating {
            animation: floating 3s ease-in-out infinite;
        }

        @keyframes floating {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
            100% { transform: translateY(0px); }
        }
    </style>
</head>
<body class="bg-slate-50 dark:bg-gray-950 text-gray-900 dark:text-gray-100 transition-colors duration-300">
    <!-- Navbar -->
    <nav class="fixed top-0 w-full z-50 glass shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">
    
    <div class="flex items-center">
        <img src="{{ asset('image/logo.webp') }}" 
             alt="Linkbayar Logo" 
             class="h-36 w-auto -my-6">
    </div>

            

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center gap-8">
                    <a href="#biaya" class="text-sm font-semibold hover:text-blue-600 transition-colors">Biaya</a>
                    <a href="#panduan" class="text-sm font-semibold hover:text-blue-600 transition-colors">Panduan</a>
                    
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
                    <button class="p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="relative pt-32 pb-20 lg:pt-48 lg:pb-32 overflow-hidden">
        <!-- Background Orbs -->
        <div class="hero-shape top-0 left-0 w-96 h-96 bg-blue-400"></div>
        <div class="hero-shape bottom-0 right-0 w-96 h-96 bg-purple-400"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400 text-xs font-bold mb-8 animate-bounce">
                <span class="flex h-2 w-2 rounded-full bg-blue-600 animate-ping"></span>
                Solusi Link Pembayaran No. 1 di Indonesia
            </div>
            
            <h1 class="text-5xl lg:text-7xl font-extrabold tracking-tight mb-6 leading-tight">
                Terima Pembayaran <br>
                <span class="bg-clip-text text-transparent bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 animate-gradient">Hanya dengan Link.</span>
            </h1>
            
            <p class="text-lg lg:text-xl text-gray-600 dark:text-gray-400 max-w-2xl mx-auto mb-10 leading-relaxed">
                Buat link pembayaran instan, bagikan ke pelanggan Anda, dan terima dana secara otomatis. Mendukung semua channel pembayaran populer.
            </p>

            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="{{ route('register') }}" class="w-full sm:w-auto px-8 py-4 bg-blue-600 text-white rounded-2xl font-bold text-lg shadow-xl shadow-blue-500/30 hover:bg-blue-700 hover:-translate-y-1 transition-all active:scale-95 flex items-center justify-center gap-2 group">
                    Mulai Sekarang
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                    </svg>
                </a>
                <a href="#panduan" class="w-full sm:w-auto px-8 py-4 bg-white dark:bg-gray-800 text-gray-900 dark:text-white rounded-2xl font-bold text-lg border border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 transition-all flex items-center justify-center gap-2">
                    Lihat Panduan
                </a>
            </div>

            <!-- Dashboard Preview Mockup -->
            <div class="mt-20 relative px-4 lg:px-0 floating">
                <div class="max-w-4xl mx-auto bg-gray-900 rounded-[2.5rem] p-4 shadow-2xl shadow-blue-500/20 border-8 border-gray-100 dark:border-gray-800">
                    <div class="bg-slate-50 dark:bg-gray-900 rounded-[1.5rem] overflow-hidden aspect-video relative">
                        <div class="absolute inset-0 flex items-center justify-center">
                            <!-- Visual placeholder representing a sleek dashboard -->
                            <div class="w-full p-8 space-y-4">
                                <div class="h-8 w-48 bg-gray-200 dark:bg-gray-800 rounded-lg"></div>
                                <div class="grid grid-cols-3 gap-4">
                                    <div class="h-32 bg-blue-100 dark:bg-blue-900/20 rounded-2xl border border-blue-200 dark:border-blue-800"></div>
                                    <div class="h-32 bg-purple-100 dark:bg-purple-900/20 rounded-2xl border border-purple-200 dark:border-purple-800"></div>
                                    <div class="h-32 bg-emerald-100 dark:bg-emerald-900/20 rounded-2xl border border-emerald-200 dark:border-emerald-800"></div>
                                </div>
                                <div class="h-48 bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Glass Card Floatings -->
                <div class="absolute -left-10 top-1/2 hidden lg:block glass p-6 rounded-2xl shadow-xl w-64 text-left border-l-4 border-l-emerald-500">
                    <p class="text-xs text-gray-500 font-bold uppercase mb-1">Pembayaran Terbaru</p>
                    <p class="text-xl font-bold">Rp 150.000</p>
                    <div class="flex items-center gap-2 mt-2">
                        <span class="px-2 py-0.5 bg-emerald-100 text-emerald-600 rounded text-[10px] font-bold">SUKSES</span>
                        <span class="text-[10px] text-gray-400">2 menit yang lalu</span>
                    </div>
                </div>
                <div class="absolute -right-10 bottom-10 hidden lg:block glass p-6 rounded-2xl shadow-xl w-64 text-left border-l-4 border-l-blue-500">
                    <p class="text-xs text-gray-500 font-bold uppercase mb-1">Total Saldo</p>
                    <p class="text-xl font-bold text-blue-600">Rp 45.280.000</p>
                    <p class="text-[10px] text-emerald-500 font-bold mt-1">▲ +12% dari bulan lalu</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Biaya Section -->
    <section id="biaya" class="py-24 bg-white dark:bg-gray-900/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl lg:text-4xl font-bold mb-4">Biaya Layanan yang <span class="text-blue-600">Transparan</span></h2>
            <p class="text-gray-600 dark:text-gray-400 max-w-2xl mx-auto mb-16">Nikmati fitur premium dengan biaya yang sangat terjangkau. Tidak ada biaya tersembunyi, semua transparan sejak awal.</p>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Fee Item 1 -->
                <div class="p-8 rounded-3xl bg-slate-50 dark:bg-gray-800 border border-gray-100 dark:border-gray-700 hover:shadow-xl transition-all hover:-translate-y-2 group">
                    <div class="w-14 h-14 bg-blue-600 rounded-2xl flex items-center justify-center text-white mb-6 group-hover:scale-110 transition-transform">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold mb-2">QRIS Instan</h3>
                    <p class="text-3xl font-black text-blue-600 mb-4">0.7%</p>
                    <p class="text-sm text-gray-500 leading-relaxed">Terima pembayaran dari semua e-wallet & aplikasi perbankan dengan aman.</p>
                </div>

                <!-- Fee Item 2 -->
                <div class="p-8 rounded-3xl bg-slate-50 dark:bg-gray-800 border border-gray-100 dark:border-gray-700 hover:shadow-xl transition-all hover:-translate-y-2 group">
                    <div class="w-14 h-14 bg-purple-600 rounded-2xl flex items-center justify-center text-white mb-6 group-hover:scale-110 transition-transform">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold mb-2">Virtual Account</h3>
                    <p class="text-3xl font-black text-purple-600 mb-4">3.000</p>
                    <p class="text-sm text-gray-500 leading-relaxed">Flat per transaksi. BCA, Mandiri, BNI, BRI, dan bank besar lainnya.</p>
                </div>

                <!-- Fee Item 3 -->
                <div class="p-8 rounded-3xl bg-slate-50 dark:bg-gray-800 border border-gray-100 dark:border-gray-700 hover:shadow-xl transition-all hover:-translate-y-2 group">
                    <div class="w-14 h-14 bg-emerald-600 rounded-2xl flex items-center justify-center text-white mb-6 group-hover:scale-110 transition-transform">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold mb-2">Penarikan Dana</h3>
                    <p class="text-3xl font-black text-emerald-600 mb-4">4.000</p>
                    <p class="text-sm text-gray-500 leading-relaxed">Flat per penarikan ke semua rekening bank di seluruh Indonesia.</p>
                </div>

                <!-- Fee Item 4 -->
                <div class="p-8 rounded-3xl bg-slate-50 dark:bg-gray-800 border border-gray-100 dark:border-gray-700 hover:shadow-xl transition-all hover:-translate-y-2 group">
                    <div class="w-14 h-14 bg-amber-600 rounded-2xl flex items-center justify-center text-white mb-6 group-hover:scale-110 transition-transform">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold mb-2">Pendaftaran</h3>
                    <p class="text-3xl font-black text-amber-600 mb-4">GRATIS</p>
                    <p class="text-sm text-gray-500 leading-relaxed">Mulai buat link dan integrasi API Anda sekarang tanpa dipungut biaya pendaftaran.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- API Section -->
    <section class="py-24 bg-slate-900 text-white overflow-hidden relative">
        <div class="hero-shape top-0 right-0 w-64 h-64 bg-blue-500/20"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row items-center gap-16">
                <div class="flex-1 space-y-8">
                    <div class="inline-block px-4 py-1.5 bg-blue-500/10 border border-blue-500/20 rounded-lg text-blue-400 text-xs font-bold uppercase tracking-widest">
                        Developer Friendly
                    </div>
                    <h2 class="text-4xl lg:text-5xl font-black leading-tight">
                        Integrasi Payment Gateway <br>
                        <span class="text-blue-500">Dengan Mudah Melalui API.</span>
                    </h2>
                    <p class="text-xl text-gray-400 leading-relaxed">
                        Gunakan <strong>API Key</strong> yang kami sediakan untuk menghubungkan sistem Anda secara langsung dengan infrastruktur pembayaran kami. Kami menyediakan dokumentasi lengkap untuk integrasi payment gateway yang aman dan handal di aplikasi atau website Anda.
                    </p>
                    <ul class="space-y-4">
                        <li class="flex items-center gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" /></svg>
                            <span class="font-medium">Otentikasi API Key yang Aman</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" /></svg>
                            <span class="font-medium">Webhook Real-time untuk Status Transaksi</span>
                        </li>
                    </ul>
                </div>
                <div class="flex-1 w-full lg:w-auto">
                    <!-- Code Snippet Box -->
                    <div class="bg-gray-800/50 border border-gray-700 rounded-3xl p-1 shadow-2xl">
                        <div class="bg-gray-900 rounded-[1.4rem] p-6 lg:p-8 font-mono text-sm overflow-x-auto">
                            <div class="flex gap-2 mb-6">
                                <div class="w-3 h-3 rounded-full bg-red-500"></div>
                                <div class="w-3 h-3 rounded-full bg-yellow-500"></div>
                                <div class="w-3 h-3 rounded-full bg-green-500"></div>
                            </div>
                            <pre class="text-blue-400">curl <span class="text-gray-400">-X POST</span> https://app.linkbayar.my.id/api/transactioncreate \</pre>
                            <pre class="text-gray-400">  -H <span class="text-emerald-400">"Authorization: Bearer YOUR_API_KEY"</span> \</pre>
                            <pre class="text-gray-400">  -H <span class="text-emerald-400">"Content-Type: application/json"</span> \</pre>
                            <pre class="text-gray-400">  -d '{</pre>
                            <pre class="text-gray-400">    <span class="text-blue-300">"amount"</span>: 25000,</pre>
                            <pre class="text-gray-400">    <span class="text-blue-300">"order_id"</span>: <span class="text-emerald-400">"ORDER-12345"</span>,</pre>
                            <pre class="text-gray-400">    <span class="text-blue-300">"customer_name"</span>: <span class="text-emerald-400">"Ahmad"</span></pre>
                            <pre class="text-gray-400">  }'</pre>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Panduan Section -->
    <section id="panduan" class="py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row items-center gap-16">
                <div class="flex-1">
                    <h2 class="text-4xl font-extrabold mb-8 leading-tight">Mulai Terima Pembayaran <br>dalam <span class="text-blue-600">3 Langkah Mudah</span></h2>
                    
                    <div class="space-y-10">
                        <!-- Step 1 -->
                        <div class="flex gap-6">
                            <div class="flex-shrink-0 w-12 h-12 rounded-2xl bg-blue-600 text-white font-black text-xl flex items-center justify-center shadow-lg shadow-blue-500/20">1</div>
                            <div>
                                <h3 class="text-xl font-bold mb-2 uppercase tracking-wide">Daftar Akun</h3>
                                <p class="text-gray-600 dark:text-gray-400">Buat akun Anda dalam 1 menit. Lengkapi data rekening bank untuk tujuan penarikan dana.</p>
                            </div>
                        </div>

                        <!-- Step 2 -->
                        <div class="flex gap-6">
                            <div class="flex-shrink-0 w-12 h-12 rounded-2xl bg-indigo-600 text-white font-black text-xl flex items-center justify-center shadow-lg shadow-indigo-500/20">2</div>
                            <div>
                                <h3 class="text-xl font-bold mb-2 uppercase tracking-wide">Buat Link / Project</h3>
                                <p class="text-gray-600 dark:text-gray-400">Buat project untuk website atau toko Anda. Dapatkan link pembayaran instan atau API key untuk integrasi sistem.</p>
                            </div>
                        </div>

                        <!-- Step 3 -->
                        <div class="flex gap-6">
                            <div class="flex-shrink-0 w-12 h-12 rounded-2xl bg-purple-600 text-white font-black text-xl flex items-center justify-center shadow-lg shadow-purple-500/20">3</div>
                            <div>
                                <h3 class="text-xl font-bold mb-2 uppercase tracking-wide">Sebarkan & Terima Dana</h3>
                                <p class="text-gray-600 dark:text-gray-400">Kirim link ke pelanggan via WhatsApp atau SMS. Saldo akan otomatis bertambah saat pembayaran sukses.</p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-12">
                        <a href="{{ route('register') }}" class="inline-flex items-center gap-2 px-8 py-3 bg-gray-900 dark:bg-white dark:text-gray-900 text-white rounded-xl font-bold hover:opacity-90 transition-all shadow-xl">
                            Daftar Sekarang Secara Gratis
                        </a>
                    </div>
                </div>
                
                <div class="flex-1 relative">
                    <div class="relative z-10 p-4 bg-gray-900 rounded-[3rem] shadow-2xl overflow-hidden floating border-8 border-gray-100 dark:border-gray-800">
                        <div class="aspect-[9/16] bg-slate-50 dark:bg-gray-900 rounded-[2rem] overflow-hidden relative p-8">
                            <!-- Mobile interface preview -->
                            <div class="w-full flex justify-between items-center mb-10">
                                <div class="w-8 h-8 rounded-full bg-blue-100 dark:bg-blue-900/40"></div>
                                <div class="w-12 h-4 rounded-full bg-gray-200 dark:bg-gray-800"></div>
                            </div>
                            
                            <div class="text-center space-y-4 mb-10">
                                <p class="text-xs font-bold text-gray-400">DETAIL PEMBAYARAN</p>
                                <h4 class="text-3xl font-black">Rp 25.000</h4>
                                <div class="px-4 py-1.5 bg-blue-100 text-blue-600 rounded-lg text-xs font-bold mx-auto w-fit">INVOICE #08234</div>
                            </div>

                            <div class="space-y-3">
                                <div class="p-4 rounded-xl border border-blue-500 bg-blue-50 dark:bg-blue-900/10 flex items-center gap-4">
                                    <div class="w-10 h-10 bg-white rounded-lg border flex items-center justify-center font-bold text-lg">Q</div>
                                    <div class="flex-1 text-sm font-bold">QRIS Instan</div>
                                    <div class="w-4 h-4 rounded-full border-4 border-blue-600 flex items-center justify-center"><div class="w-2 h-2 rounded-full bg-blue-600"></div></div>
                                </div>
                                <div class="p-4 rounded-xl border border-gray-100 dark:border-gray-800 bg-white dark:bg-gray-800 flex items-center gap-4">
                                    <div class="w-10 h-10 bg-white rounded-lg border flex items-center justify-center font-bold text-lg text-blue-800">BNI</div>
                                    <div class="flex-1 text-sm font-bold">Virtual Account</div>
                                </div>
                                <div class="p-4 rounded-xl border border-gray-100 dark:border-gray-800 bg-white dark:bg-gray-800 flex items-center gap-4">
                                    <div class="w-10 h-10 bg-white rounded-lg border flex items-center justify-center font-bold text-lg text-blue-600 text-sm">OVO</div>
                                    <div class="flex-1 text-sm font-bold">E-Wallet</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-400 py-12 border-t border-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row justify-between items-center gap-8">
         <div class="flex items-center">
    <img src="{{ asset('image/logo.webp') }}" 
         alt="Linkbayar Logo" 
         class="h-36 w-auto -my-6">
</div>
            
            <div class="flex items-center gap-8 text-sm">
                <a href="#biaya" class="hover:text-white transition-colors">Biaya</a>
                <a href="#panduan" class="hover:text-white transition-colors">Panduan</a>
                <a href="{{ route('login') }}" class="hover:text-white transition-colors">Login</a>
                <a href="{{ route('register') }}" class="hover:text-white transition-colors">Register</a>
            </div>

            <div class="text-xs">
                &copy; {{ date('Y') }} Linkbayar Indonesia. All rights reserved.
            </div>
        </div>
    </footer>

    <script>
        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    </script>
</body>
</html>
