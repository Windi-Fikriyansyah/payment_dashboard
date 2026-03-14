<x-app-layout>
    <x-slot name="header">
        Overview
    </x-slot>

    <div class="space-y-8">
        <!-- Welcome Section -->
        <div class="bg-blue-600 rounded-3xl p-8 text-white relative overflow-hidden shadow-xl shadow-blue-500/20">
            <div class="relative z-10">
                <h1 class="text-3xl font-bold mb-2">Selamat Datang, {{ Auth::user()->name }}! 👋</h1>
                <p class="text-blue-100 max-w-md">Dashboard pembayaran Anda sudah siap. Ada {{ $penarikan_pending }} permintaan penarikan yang perlu diproses.</p>
                <div class="mt-6 flex gap-3">
                    <button class="px-5 py-2.5 bg-white text-blue-600 rounded-xl font-bold text-sm shadow-sm hover:bg-gray-50 transition-colors">View Reports</button>
                    <button class="px-5 py-2.5 bg-blue-500/50 text-white rounded-xl font-bold text-sm shadow-sm backdrop-blur-sm border border-blue-400/30 hover:bg-blue-500/70 transition-colors">Manage Payments</button>
                </div>
            </div>
            
            <!-- Abstract Background Shapes -->
            <div class="absolute -right-20 -top-20 w-80 h-80 bg-blue-500 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-pulse"></div>
            <div class="absolute -right-40 -bottom-40 w-80 h-80 bg-blue-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-pulse delay-700"></div>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- card 1 -->
            <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm hover:shadow-md transition-shadow group">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-blue-50 dark:bg-blue-900/30 rounded-xl flex items-center justify-center text-blue-600 transition-transform group-hover:scale-110">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
                <h3 class="text-gray-500 dark:text-gray-400 text-sm font-medium">Saldo Tersedia</h3>
                <p class="text-2xl font-bold text-gray-900 dark:text-white mt-1">Rp {{ number_format($total_saldo, 0, ',', '.') }}</p>
                <div class="mt-2 flex items-center gap-2 text-xs">
                    <span class="text-emerald-500 font-bold">Produksi</span>
                    <span class="text-gray-400">Total bersih semua proyek</span>
                </div>
            </div>

            <!-- card 2 -->
            <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm hover:shadow-md transition-shadow group">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-purple-50 dark:bg-purple-900/30 rounded-xl flex items-center justify-center text-purple-600 transition-transform group-hover:scale-110">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 118 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                    </div>
                </div>
                <h3 class="text-gray-500 dark:text-gray-400 text-sm font-medium">Transaksi Berhasil</h3>
                <p class="text-2xl font-bold text-gray-900 dark:text-white mt-1">{{ number_format($total_transaksi, 0, ',', '.') }}</p>
                <div class="mt-2 flex items-center gap-2 text-xs">
                    <span class="text-emerald-500 font-bold">Produksi</span>
                    <span class="text-gray-400">Total volume transaksi</span>
                </div>
            </div>

             <!-- card 3 -->
             <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm hover:shadow-md transition-shadow group">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-amber-50 dark:bg-amber-900/30 rounded-xl flex items-center justify-center text-amber-600 transition-transform group-hover:scale-110">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                </div>
                <h3 class="text-gray-500 dark:text-gray-400 text-sm font-medium">Penarikan Pending</h3>
                <p class="text-2xl font-bold text-gray-900 dark:text-white mt-1">{{ $penarikan_pending }}</p>
                <div class="mt-2 flex items-center gap-2 text-xs">
                    <span class="text-amber-500 font-bold">Menunggu</span>
                    <span class="text-gray-400">Perlu diproses malam ini</span>
                </div>
            </div>

             <!-- card 4 -->
             <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm hover:shadow-md transition-shadow group">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-rose-50 dark:bg-rose-900/30 rounded-xl flex items-center justify-center text-rose-600 transition-transform group-hover:scale-110">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                </div>
                <h3 class="text-gray-500 dark:text-gray-400 text-sm font-medium">Total Proyek</h3>
                <p class="text-2xl font-bold text-gray-900 dark:text-white mt-1">{{ $total_proyek }}</p>
                <div class="mt-2 flex items-center gap-2 text-xs">
                    <span class="text-blue-500 font-bold">Aktif</span>
                    <span class="text-gray-400">Sandbox & Produksi</span>
                </div>
            </div>
        </div>

        <!-- Recent Activity table could go here -->
    </div>
</x-app-layout>

