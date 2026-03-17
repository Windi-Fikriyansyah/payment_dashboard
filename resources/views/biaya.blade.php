<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Biaya Layanan - Linkbayar Indonesia</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            font-family: 'Outfit', sans-serif;
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
                    <a href="{{ route('biaya') }}" class="text-sm font-semibold text-blue-600 transition-colors">Biaya</a>
                    
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

    <!-- Header Section -->
    <section class="relative pt-32 pb-16 lg:pt-48 lg:pb-24 overflow-hidden">
        <div class="hero-shape top-0 left-0 w-96 h-96 bg-blue-400"></div>
        <div class="hero-shape bottom-0 right-0 w-96 h-96 bg-purple-400"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl lg:text-6xl font-extrabold tracking-tight mb-6 leading-tight">
                Biaya Layanan <br>
                <span class="bg-clip-text text-transparent bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 animate-gradient">Transparan & Kompetitif.</span>
            </h1>
            <p class="text-lg text-gray-600 dark:text-gray-400 max-w-2xl mx-auto mb-10 leading-relaxed">
                Kami menawarkan biaya layanan yang sangat terjangkau untuk membantu pertumbuhan bisnis Anda. Tidak ada biaya pendaftaran atau biaya bulanan.
            </p>
        </div>
    </section>

    <!-- Content Section -->
    <section class="pb-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- QRIS Section -->
            <div class="mb-16">
                <div class="flex items-center gap-4 mb-8">
                    <div class="w-12 h-12 bg-blue-600 rounded-2xl flex items-center justify-center text-white shadow-lg shadow-blue-500/20">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z" />
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold">QRIS</h2>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div class="p-6 rounded-3xl bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 shadow-sm hover:shadow-xl transition-all">
                        <div class="flex items-center justify-between mb-6">
                            <img src="https://ik.imagekit.io/tg7tsodt8/about/bank/images.png" alt="QRIS" class="h-10 object-contain">
                            <span class="px-3 py-1 bg-emerald-100 text-emerald-600 rounded-full text-xs font-bold uppercase">Semua E-Wallet</span>
                        </div>
                        <h3 class="text-xl font-bold mb-4">QRIS Instan</h3>
                        <div class="space-y-3">
                            <div class="flex justify-between items-center text-sm">
                                <span class="text-gray-500">Biaya</span>
                                <span class="font-bold text-blue-600">0.7% + Rp 310</span>
                            </div>
                            
                        
                        </div>
                    </div>
                </div>
            </div>

            <!-- Virtual Account Section -->
            <div>
                <div class="flex items-center gap-4 mb-8">
                    <div class="w-12 h-12 bg-purple-600 rounded-2xl flex items-center justify-center text-white shadow-lg shadow-purple-500/20">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold">Virtual Account</h2>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @php
                        $va_methods = [
                            ['name' => 'BCA Virtual Account', 'logo' => 'https://ik.imagekit.io/tg7tsodt8/about/bank/Logo%20BCA_Biru.png', 'fee' => '5.500', 'code' => 'BC'],
                            ['name' => 'ATM Bersama', 'logo' => 'https://ik.imagekit.io/tg7tsodt8/about/bank/A1.png', 'fee' => '3.500', 'code' => 'A1'],
                            ['name' => 'Permata Virtual Account', 'logo' => 'https://ik.imagekit.io/tg7tsodt8/about/bank/PERMATA.png', 'fee' => '3.500', 'code' => 'BT'],
                            ['name' => 'Maybank Virtual Account', 'logo' => 'https://ik.imagekit.io/tg7tsodt8/about/bank/VA.png', 'fee' => '3.500', 'code' => 'VA'],
                            ['name' => 'Mandiri Virtual Account', 'logo' => 'https://ik.imagekit.io/tg7tsodt8/about/bank/MV.png', 'fee' => '4.500', 'code' => 'M2'],
                            ['name' => 'CIMB Niaga Virtual Account', 'logo' => 'https://ik.imagekit.io/tg7tsodt8/about/bank/B1.png', 'fee' => '3.500', 'code' => 'B1'],
                            ['name' => 'Artha Graha Virtual Account', 'logo' => 'https://ik.imagekit.io/tg7tsodt8/about/bank/AG.jpg', 'fee' => '2.000', 'code' => 'AG'],
                            ['name' => 'BNI Virtual Account', 'logo' => 'https://ik.imagekit.io/tg7tsodt8/about/bank/I1.png', 'fee' => '3.500', 'code' => 'I1'],
                            ['name' => 'BNC Virtual Account', 'logo' => 'https://ik.imagekit.io/tg7tsodt8/about/bank/NC.webp', 'fee' => '3.500', 'code' => 'BN'],
                            ['name' => 'BRI Virtual Account', 'logo' => 'https://ik.imagekit.io/tg7tsodt8/about/bank/BR.png', 'fee' => '3.500', 'code' => 'BR'],
                        ];
                    @endphp

                    @foreach($va_methods as $method)
                    <div class="p-6 rounded-3xl bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 shadow-sm hover:shadow-xl transition-all">
                        <div class="flex items-center justify-between mb-6">
                            <img src="{{ $method['logo'] }}" alt="{{ $method['name'] }}" class="h-8 max-w-[120px] object-contain">
                            <span class="px-3 py-1 bg-blue-100 text-blue-600 rounded-full text-xs font-bold uppercase">{{ $method['code'] }}</span>
                        </div>
                        <h3 class="text-md font-bold mb-4 line-clamp-1">{{ $method['name'] }}</h3>
                        <div class="space-y-3">
                            <div class="flex justify-between items-center text-sm">
                                <span class="text-gray-500">Biaya</span>
                                <span class="font-bold text-blue-600">Rp {{ $method['fee'] }}</span>
                            </div>
                            
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Additional Info -->
            <div class="mt-20 p-8 rounded-[2.5rem] bg-slate-900 text-white relative overflow-hidden">
                <div class="hero-shape top-0 right-0 w-64 h-64 bg-blue-500/20"></div>
                <div class="relative z-10 flex flex-col md:flex-row items-center justify-between gap-8">
                    <div class="max-w-xl">
                        <h2 class="text-2xl font-bold mb-2">Penting untuk Diketahui</h2>
                        <div class="text-gray-400 space-y-2">
                            <p><span class="text-blue-400 font-bold">Catatan:</span> QRIS untuk nominal diatas Rp 100.000, biayanya menjadi <strong>1% + Rp 0</strong></p>
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
                <a href="{{ route('home') }}">
                    <img src="{{ asset('image/logo.webp') }}" alt="Linkbayar Logo" class="h-36 w-auto -my-6">
                </a>
            </div>
            
            <div class="flex items-center gap-8 text-sm">
                <a href="{{ route('biaya') }}" class="hover:text-white transition-colors">Biaya</a>
                <a href="{{ route('panduan') }}" class="hover:text-white transition-colors">Panduan</a>
                <a href="{{ route('login') }}" class="hover:text-white transition-colors">Login</a>
                <a href="{{ route('register') }}" class="hover:text-white transition-colors">Register</a>
            </div>

            <div class="text-xs">
                &copy; {{ date('Y') }} Linkbayar Indonesia. All rights reserved.
            </div>
        </div>
    </footer>
</body>
</html>
