<x-app-layout>
    <x-slot name="header">
        Tutorial & Panduan Penggunaan
    </x-slot>

    <div class="space-y-8 animate-in fade-in slide-in-from-bottom-4 duration-700">
        <!-- Header Section -->
        <div class="bg-white dark:bg-gray-800 rounded-3xl p-8 border border-gray-100 dark:border-gray-700 shadow-xl relative overflow-hidden group">
            <div class="absolute -right-20 -top-20 w-64 h-64 bg-blue-500/10 rounded-full blur-3xl pointer-events-none group-hover:scale-110 transition-transform duration-1000"></div>
            <div class="relative z-10 space-y-4">
                <span class="px-3 py-1 bg-blue-100 text-blue-600 dark:bg-blue-900/30 dark:text-blue-400 rounded-full text-sm font-bold tracking-wide uppercase">Tutorial Video</span>
                <h1 class="text-3xl font-extrabold text-gray-900 dark:text-white">Pelajari Fitur-fitur Linkbayar</h1>
                <p class="text-gray-500 dark:text-gray-400 max-w-2xl leading-relaxed text-lg">
                    Tonton video tutotial singkat berikut untuk memandu Anda mengatur proyek, mode Sandbox/Production, dan memodifikasi metode pembebanan fee.
                </p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- Video Tutorial 1 -->
            <div class="bg-white dark:bg-gray-800 p-6 rounded-3xl border border-gray-100 dark:border-gray-700 shadow-sm hover:shadow-xl transition-all h-full flex flex-col group">
                <div class="flex items-center gap-4 mb-4">
                    <div class="p-3 bg-emerald-100 dark:bg-emerald-900/30 rounded-2xl group-hover:bg-emerald-200 dark:group-hover:bg-emerald-900/50 transition-colors">
                        <svg class="w-6 h-6 text-emerald-600 dark:text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-lg font-bold text-gray-900 dark:text-white leading-tight">Cara Mengaktifkan Bot WhatsApp</h2>
                    </div>
                </div>
                <div class="relative w-full overflow-hidden rounded-xl pt-[56.25%] flex-shrink-0 bg-gray-100 dark:bg-gray-900 shadow-inner">
                    <!-- Ganti "VIDEO_ID_1" dengan ID video YouTube yang sebenarnya (.contoh dari https://www.youtube.com/watch?v=VIDEO_ID) -->
                    <iframe class="absolute top-0 left-0 w-full h-full border-0" 
                        src="https://www.youtube.com/embed/dQw4w9WgXcQ?rel=0" 
                        title="Tutorial Mengaktifkan Bot WhatsApp" 
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                        allowfullscreen>
                    </iframe>
                </div>
                
            </div>

            <!-- Video Tutorial 2 -->
            <div class="bg-white dark:bg-gray-800 p-6 rounded-3xl border border-gray-100 dark:border-gray-700 shadow-sm hover:shadow-xl transition-all h-full flex flex-col group">
                <div class="flex items-center gap-4 mb-4">
                    <div class="p-3 bg-purple-100 dark:bg-purple-900/30 rounded-2xl group-hover:bg-purple-200 dark:group-hover:bg-purple-900/50 transition-colors">
                        <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-lg font-bold text-gray-900 dark:text-white leading-tight">Ganti Mode Sandbox ke Production</h2>
                    </div>
                </div>
                <div class="relative w-full overflow-hidden rounded-xl pt-[56.25%] flex-shrink-0 bg-gray-100 dark:bg-gray-900 shadow-inner">
                    <!-- Ganti "VIDEO_ID_2" dengan ID video YouTube yang sebenarnya -->
                    <iframe class="absolute top-0 left-0 w-full h-full border-0" 
                        src="https://www.youtube.com/embed/dQw4w9WgXcQ?rel=0" 
                        title="Tutorial Ganti Mode Sandbox ke Production" 
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                        allowfullscreen>
                    </iframe>
                </div>
               
            </div>

            <!-- Video Tutorial 3 -->
            <div class="bg-white dark:bg-gray-800 p-6 rounded-3xl border border-gray-100 dark:border-gray-700 shadow-sm hover:shadow-xl transition-all h-full flex flex-col group">
                <div class="flex items-center gap-4 mb-4">
                    <div class="p-3 bg-amber-100 dark:bg-amber-900/30 rounded-2xl group-hover:bg-amber-200 dark:group-hover:bg-amber-900/50 transition-colors">
                        <svg class="w-6 h-6 text-amber-600 dark:text-amber-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-lg font-bold text-gray-900 dark:text-white leading-tight">Ganti Fee ditanggung Customer/Merchant</h2>
                    </div>
                </div>
                <div class="relative w-full overflow-hidden rounded-xl pt-[56.25%] flex-shrink-0 bg-gray-100 dark:bg-gray-900 shadow-inner">
                    <!-- Ganti "VIDEO_ID_3" dengan ID video YouTube yang sebenarnya -->
                    <iframe class="absolute top-0 left-0 w-full h-full border-0" 
                        src="https://www.youtube.com/embed/dQw4w9WgXcQ?rel=0" 
                        title="Tutorial Pembebanan Biaya Transaksi" 
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                        allowfullscreen>
                    </iframe>
                </div>
                
            </div>

        </div>
    </div>
</x-app-layout>
