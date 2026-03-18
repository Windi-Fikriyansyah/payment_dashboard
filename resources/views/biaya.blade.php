<x-public-layout>
    <x-slot:title>Biaya Layanan - Linkbayar Indonesia</x-slot:title>

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

    @php
        $qris = $payment_methods->where('code', 'qris')->first();
        $va_methods = $payment_methods->where('code', '!=', 'qris');
    @endphp

    <!-- Content Section -->
    <section class="pb-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- QRIS Section -->
            @if($qris)
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
                            <img src="{{ $qris->image_url }}" alt="QRIS" class="h-10 object-contain">
                        </div>
                        <h3 class="text-xl font-bold mb-4">{{ $qris->name }}</h3>
                        <div class="space-y-3">
                            <div class="flex justify-between items-center text-sm">
                                <span class="text-gray-500">Biaya</span>
                                <span class="font-bold text-blue-600">
                                    {{ $qris->fee_percent * 100 }}% 
                                    @if($qris->fee_flat > 0)
                                        + Rp {{ number_format($qris->fee_flat, 2, ',', '.') }}
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- Virtual Account Section -->
            @if($va_methods->count() > 0)
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
                    @foreach($va_methods as $method)
                    <div class="p-6 rounded-3xl bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 shadow-sm hover:shadow-xl transition-all">
                        <div class="flex items-center justify-between mb-6">
                            <img src="{{ $method->image_url }}" alt="{{ $method->name }}" class="h-8 max-w-[120px] object-contain">
                            <span class="px-3 py-1 bg-blue-100 text-blue-600 rounded-full text-xs font-bold uppercase">{{ strtoupper($method->code) }}</span>
                        </div>
                        <h3 class="text-md font-bold mb-4 line-clamp-1">{{ $method->name }}</h3>
                        <div class="space-y-3">
                            <div class="flex justify-between items-center text-sm">
                                <span class="text-gray-500">Biaya</span>
                                <span class="font-bold text-blue-600">
                                    @if($method->fee_percent > 0)
                                        {{ $method->fee_percent * 100 }}% 
                                    @endif
                                    @if($method->fee_flat > 0)
                                        @if($method->fee_percent > 0) + @endif
                                        Rp {{ number_format($method->fee_flat, 2, ',', '.') }}
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

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
</x-public-layout>
