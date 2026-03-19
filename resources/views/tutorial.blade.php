<x-app-layout>
    <x-slot name="header">
        Tutorial & Panduan Penggunaan
    </x-slot>

    <div class="space-y-8 animate-in fade-in slide-in-from-bottom-4 duration-700">
        <!-- Header Section -->
        <div class="bg-white dark:bg-gray-800 rounded-3xl p-8 border border-gray-100 dark:border-gray-700 shadow-xl relative overflow-hidden group">
            <div class="absolute -right-20 -top-20 w-64 h-64 bg-blue-500/10 rounded-full blur-3xl pointer-events-none group-hover:scale-110 transition-transform duration-1000"></div>
            <div class="relative z-10 space-y-4">
                <span class="px-3 py-1 bg-blue-100 text-blue-600 dark:bg-blue-900/30 dark:text-blue-400 rounded-full text-sm font-bold tracking-wide uppercase">Tutorial</span>
                <h1 class="text-3xl font-extrabold text-gray-900 dark:text-white">Tutorial Penggunaan Bot WhatsApp Pembayaran</h1>
                <p class="text-gray-500 dark:text-gray-400 max-w-2xl leading-relaxed text-lg">
                    Ikuti langkah-langkah mudah berikut ini untuk mulai menerima pembayaran secara otomatis melalui bot WhatsApp.
                </p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Step 1 -->
            <div class="bg-white dark:bg-gray-800 p-8 rounded-3xl border border-gray-100 dark:border-gray-700 shadow-sm hover:shadow-xl transition-all h-full flex flex-col group relative overflow-hidden">
                <div class="absolute top-0 right-0 p-8 text-8xl font-black text-gray-50 dark:text-gray-900/50 -mt-8 -mr-8 group-hover:scale-110 transition-transform duration-500 pointer-events-none">1</div>
                <div class="relative z-10">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="p-4 bg-emerald-100 dark:bg-emerald-900/30 rounded-2xl group-hover:bg-emerald-200 dark:group-hover:bg-emerald-900/50 transition-colors">
                            <svg class="w-8 h-8 text-emerald-600 dark:text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <h2 class="text-xl font-bold text-gray-900 dark:text-white leading-tight">Tambahkan Nomor WhatsApp</h2>
                    </div>
                    <ul class="space-y-3 text-gray-600 dark:text-gray-300">
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-emerald-500 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            <span>Masuk ke menu <strong>Tambah Proyek</strong> atau <strong>Edit Proyek</strong></span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-emerald-500 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            <span>Masukkan nomor WhatsApp Anda yang akan digunakan untuk menerima transaksi</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-emerald-500 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            <span>Pastikan nomor aktif dan bisa menerima pesan</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Step 2 -->
            <div class="bg-white dark:bg-gray-800 p-8 rounded-3xl border border-gray-100 dark:border-gray-700 shadow-sm hover:shadow-xl transition-all h-full flex flex-col group relative overflow-hidden">
                <div class="absolute top-0 right-0 p-8 text-8xl font-black text-gray-50 dark:text-gray-900/50 -mt-8 -mr-8 group-hover:scale-110 transition-transform duration-500 pointer-events-none">2</div>
                <div class="relative z-10">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="p-4 bg-purple-100 dark:bg-purple-900/30 rounded-2xl group-hover:bg-purple-200 dark:group-hover:bg-purple-900/50 transition-colors">
                            <svg class="w-8 h-8 text-purple-600 dark:text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                            </svg>
                        </div>
                        <h2 class="text-xl font-bold text-gray-900 dark:text-white leading-tight">Atur Metode Pembayaran</h2>
                    </div>
                    <ul class="space-y-3 text-gray-600 dark:text-gray-300">
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-purple-500 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            <span>Pilih metode pembayaran yang ingin ditampilkan ke pembeli (contoh: QRIS, Virtual Account, dll)</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-purple-500 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            <span>Sesuaikan dengan kebutuhan bisnis Anda</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-purple-500 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            <span>Simpan pengaturan setelah selesai</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Step 3 -->
            <div class="bg-white dark:bg-gray-800 p-8 rounded-3xl border border-gray-100 dark:border-gray-700 shadow-sm hover:shadow-xl transition-all h-full flex flex-col group relative overflow-hidden">
                <div class="absolute top-0 right-0 p-8 text-8xl font-black text-gray-50 dark:text-gray-900/50 -mt-8 -mr-8 group-hover:scale-110 transition-transform duration-500 pointer-events-none">3</div>
                <div class="relative z-10">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="p-4 bg-amber-100 dark:bg-amber-900/30 rounded-2xl group-hover:bg-amber-200 dark:group-hover:bg-amber-900/50 transition-colors">
                            <svg class="w-8 h-8 text-amber-600 dark:text-amber-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <h2 class="text-xl font-bold text-gray-900 dark:text-white leading-tight">Simpan Nomor Bot WhatsApp</h2>
                    </div>
                    <ul class="space-y-3 text-gray-600 dark:text-gray-300">
                        <li class="flex flex-col items-start space-y-2">
                            <span>Simpan nomor bot berikut di kontak Anda:</span>
                            <div class="bg-gray-100 dark:bg-gray-900 px-4 py-3 rounded-xl font-bold text-xl text-gray-900 dark:text-white w-full text-center border border-gray-200 dark:border-gray-700 tracking-wider">
                                089622981080
                            </div>
                        </li>
                        <li class="flex items-start mt-4">
                            <svg class="w-5 h-5 text-amber-500 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <span>Ini adalah nomor bot yang akan memproses transaksi</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Step 4 -->
            <div class="bg-white dark:bg-gray-800 p-8 rounded-3xl border border-gray-100 dark:border-gray-700 shadow-sm hover:shadow-xl transition-all h-full flex flex-col group relative overflow-hidden">
                <div class="absolute top-0 right-0 p-8 text-8xl font-black text-gray-50 dark:text-gray-900/50 -mt-8 -mr-8 group-hover:scale-110 transition-transform duration-500 pointer-events-none">4</div>
                <div class="relative z-10">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="p-4 bg-blue-100 dark:bg-blue-900/30 rounded-2xl group-hover:bg-blue-200 dark:group-hover:bg-blue-900/50 transition-colors">
                            <svg class="w-8 h-8 text-blue-600 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                            </svg>
                        </div>
                        <h2 class="text-xl font-bold text-gray-900 dark:text-white leading-tight">Mulai Transaksi via WhatsApp</h2>
                    </div>
                    <ul class="space-y-4 text-gray-600 dark:text-gray-300">
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-blue-500 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            <span>Buka chat ke bot melalui WhatsApp</span>
                        </li>
                        <li class="flex flex-col items-start space-y-2 mt-2">
                            <span>Kirim pesan dengan format berikut:</span>
                            <div class="bg-gray-100 dark:bg-gray-900 px-5 py-3 rounded-xl font-mono text-base text-gray-900 dark:text-white w-full border border-gray-200 dark:border-gray-700">
                                namapembeli#harga<br>
                                <span class="text-gray-500 dark:text-gray-400 text-sm mt-3 block font-sans">Contoh:</span>
                                andi#20000
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            
            <!-- Result Section -->
            <div class="md:col-span-2 bg-gradient-to-r from-blue-600 to-indigo-600 dark:from-blue-900 dark:to-indigo-900 p-8 md:p-10 rounded-3xl shadow-xl relative overflow-hidden group">
                <div class="absolute -right-10 -top-10 w-64 h-64 bg-white/10 rounded-full blur-3xl pointer-events-none group-hover:scale-110 transition-transform duration-700"></div>
                <div class="relative z-10">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="p-4 bg-white/20 rounded-2xl backdrop-blur-sm shadow-inner">
                            <span class="text-3xl">🎯</span>
                        </div>
                        <h2 class="text-3xl font-bold text-white leading-tight">Hasilnya</h2>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
                        <div class="bg-white/10 hover:bg-white/15 transition-colors backdrop-blur-md rounded-2xl p-6 border border-white/20 shadow-lg">
                            <div class="text-white font-medium flex items-start gap-4">
                                <div class="bg-blue-500/30 p-2 rounded-lg shrink-0">
                                    <svg class="w-6 h-6 text-blue-100" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path></svg>
                                </div>
                                <span class="leading-relaxed">Bot akan otomatis membuat link pembayaran</span>
                            </div>
                        </div>
                        <div class="bg-white/10 hover:bg-white/15 transition-colors backdrop-blur-md rounded-2xl p-6 border border-white/20 shadow-lg">
                            <div class="text-white font-medium flex items-start gap-4">
                                <div class="bg-blue-500/30 p-2 rounded-lg shrink-0">
                                    <svg class="w-6 h-6 text-blue-100" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                </div>
                                <span class="leading-relaxed">Pembeli bisa langsung bayar sesuai nominal</span>
                            </div>
                        </div>
                        <div class="bg-white/10 hover:bg-white/15 transition-colors backdrop-blur-md rounded-2xl p-6 border border-white/20 shadow-lg">
                            <div class="text-white font-medium flex items-start gap-4">
                                <div class="bg-blue-500/30 p-2 rounded-lg shrink-0">
                                    <svg class="w-6 h-6 text-blue-100" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                                </div>
                                <span class="leading-relaxed">Anda tinggal menunggu notifikasi pembayaran masuk</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
