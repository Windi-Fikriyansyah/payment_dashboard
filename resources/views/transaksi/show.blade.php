<x-app-layout>
    <x-slot name="header">
        Detail Transaksi
    </x-slot>

    <div class="max-w-5xl mx-auto space-y-6">
        <!-- Header & Back Button -->
        <div class="flex items-center justify-between">
            <a href="{{ route('transaksi.index') }}" class="flex items-center text-sm font-semibold text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Kembali ke Daftar
            </a>
            <div class="flex gap-2">
                @php
                    $color = 'gray';
                    $status = strtolower($transaction->status);
                    if ($status === 'success' || $status === 'berhasil' || $status === 'paid') {
                        $color = 'emerald';
                    } elseif ($status === 'pending' || $status === 'tertunda') {
                        $color = 'amber';
                    } elseif ($status === 'failed' || $status === 'gagal' || $status === 'expired') {
                        $color = 'rose';
                    }
                @endphp
                <span class="px-3 py-1 bg-{{ $color }}-100 text-{{ $color }}-600 rounded-full text-xs font-bold uppercase tracking-wider">
                    {{ $transaction->status }} 
                    @if($status === 'pending' || $status === 'tertunda')
                        <span class="ml-1">↗</span>
                    @elseif($status === 'success' || $status === 'berhasil' || $status === 'paid')
                        <span class="ml-1">✓</span>
                    @endif
                </span>
            </div>
        </div>

        <!-- Transaction Card -->
        <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-xl border border-gray-100 dark:border-gray-700 overflow-hidden">
            <!-- Card Header -->
            <div class="px-8 py-6 border-b border-gray-50 dark:border-gray-700/50 bg-gray-50/50 dark:bg-gray-900/20">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <div>
                        <h2 class="text-xl font-bold text-gray-900 dark:text-white">Informasi Transaksi</h2>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Ref ID: {{ $transaction->reference }}</p>
                    </div>
                    <div class="text-left md:text-right">
                        <span class="px-3 py-1 bg-{{ strtolower($transaction->mode) === 'production' ? 'rose' : 'blue' }}-100 text-{{ strtolower($transaction->mode) === 'production' ? 'rose' : 'blue' }}-600 rounded-lg text-xs font-bold uppercase">
                            {{ $transaction->mode }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Card Content -->
            <div class="px-8 py-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-y-6 gap-x-12">
                    <!-- Left Column -->
                    <div class="space-y-6">
                        <div class="flex justify-between items-center pb-3 border-b border-gray-50 dark:border-gray-700">
                            <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Tanggal</span>
                            <span class="text-sm font-bold text-gray-900 dark:text-white">{{ date('Y-m-d H:i', strtotime($transaction->created_at)) }}</span>
                        </div>
                        <div class="flex justify-between items-center pb-3 border-b border-gray-50 dark:border-gray-700">
                            <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Order Id</span>
                            <span class="text-sm font-mono font-bold text-gray-900 dark:text-white">{{ $transaction->order_id }}</span>
                        </div>
                        <div class="flex justify-between items-center pb-3 border-b border-gray-50 dark:border-gray-700">
                            <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Proyek</span>
                            <span class="text-sm font-bold text-indigo-600 dark:text-indigo-400">{{ $transaction->nama_proyek }}</span>
                        </div>
                        <div class="flex justify-between items-center pb-3 border-b border-gray-50 dark:border-gray-700">
                            <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Metode</span>
                            <span class="text-sm font-bold text-gray-900 dark:text-white uppercase">{{ $transaction->payment_method ?? '-' }}</span>
                        </div>
                        <div class="flex justify-between items-center pb-3 border-b border-gray-50 dark:border-gray-700">
                            <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Nomor Bayar</span>
                            <span class="text-sm font-mono font-bold text-gray-900 dark:text-white">{{ $transaction->payment_number ?? '-' }}</span>
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="space-y-6">
                        <div class="flex justify-between items-center pb-3 border-b border-gray-50 dark:border-gray-700">
                            <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Jumlah</span>
                            <span class="text-sm font-bold text-gray-900 dark:text-white">Rp {{ number_format($transaction->amount, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between items-center pb-3 border-b border-gray-50 dark:border-gray-700">
                            <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Diterima</span>
                            <span class="text-sm font-bold text-emerald-600 dark:text-emerald-400">Rp {{ number_format($transaction->total_payment - $transaction->fee, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between items-center pb-3 border-b border-gray-50 dark:border-gray-700">
                            <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Biaya Admin</span>
                            <span class="text-sm font-bold text-gray-900 dark:text-white">Rp {{ number_format($transaction->amount == $transaction->total_payment ? 0 : $transaction->fee, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between items-center pb-3 border-b border-gray-50 dark:border-gray-700">
                            <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Bayar</span>
                            <span class="text-base font-black text-gray-900 dark:text-white font-mono">Rp {{ number_format($transaction->total_payment, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between items-center pb-3 border-b border-gray-50 dark:border-gray-700">
                            <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Dibayar Pada</span>
                            <span class="text-sm font-bold text-gray-900 dark:text-white">
                                {{ ($status === 'success' || $status === 'berhasil' || $status === 'paid') ? date('Y-m-d H:i', strtotime($transaction->updated_at)) : '-' }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer Action -->
            
        </div>
    </div>
</x-app-layout>
