<x-app-layout>
    <x-slot name="header">
        Panduan API
    </x-slot>

    <div class="max-w-5xl mx-auto space-y-8 pb-20">
        <!-- Documentation Header -->
        <div class="bg-gradient-to-br from-blue-600 to-blue-800 rounded-3xl p-8 lg:p-12 text-white shadow-xl relative overflow-hidden">
            <div class="relative z-10">
                <h1 class="text-3xl lg:text-4xl font-extrabold mb-4">Dokumentasi API Payment Gateway</h1>
                <p class="text-blue-100 text-lg lg:text-xl max-w-2xl font-medium">LinkBayar - Integrasikan sistem pembayaran modern ke website atau aplikasi Anda dengan mudah.</p>
                <div class="mt-8 flex items-center gap-3 text-sm text-blue-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Terakhir diperbarui: 10 Maret 2026
                </div>
            </div>
            <!-- Decorative Elements -->
            <div class="absolute -right-20 -bottom-20 w-80 h-80 bg-white/10 rounded-full blur-3xl"></div>
            <div class="absolute right-10 top-10 w-20 h-20 bg-blue-400/20 rounded-full blur-xl"></div>
        </div>

        <!-- Navigation Shortcut Cards -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <a href="#autentikasi" class="p-4 bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm hover:shadow-md transition-all text-center group">
                <div class="w-10 h-10 bg-blue-50 dark:bg-blue-900/30 rounded-xl flex items-center justify-center mx-auto mb-3 group-hover:bg-blue-600 group-hover:text-white transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                    </svg>
                </div>
                <span class="text-sm font-bold text-gray-700 dark:text-gray-300">Autentikasi</span>
            </a>
            <a href="#daftar-api" class="p-4 bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm hover:shadow-md transition-all text-center group">
                <div class="w-10 h-10 bg-purple-50 dark:bg-purple-900/30 rounded-xl flex items-center justify-center mx-auto mb-3 group-hover:bg-purple-600 group-hover:text-white transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l3 3-3 3m5 0h3M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
                <span class="text-sm font-bold text-gray-700 dark:text-gray-300">Daftar API</span>
            </a>
            <a href="#webhook" class="p-4 bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm hover:shadow-md transition-all text-center group">
                <div class="w-10 h-10 bg-emerald-50 dark:bg-emerald-900/30 rounded-xl flex items-center justify-center mx-auto mb-3 group-hover:bg-emerald-600 group-hover:text-white transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4" />
                    </svg>
                </div>
                <span class="text-sm font-bold text-gray-700 dark:text-gray-300">Webhook</span>
            </a>
            <a href="#biaya" class="p-4 bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm hover:shadow-md transition-all text-center group">
                <div class="w-10 h-10 bg-amber-50 dark:bg-amber-900/30 rounded-xl flex items-center justify-center mx-auto mb-3 group-hover:bg-amber-600 group-hover:text-white transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <span class="text-sm font-bold text-gray-700 dark:text-gray-300">Skema Biaya</span>
            </a>
        </div>

        <!-- Section: Pendahuluan -->
        <section id="pendahuluan" class="bg-white dark:bg-gray-800 rounded-3xl border border-gray-100 dark:border-gray-700 shadow-sm overflow-hidden">
            <div class="p-8">
                <div class="flex items-center gap-4 mb-6">
                    <div class="p-3 bg-blue-100 dark:bg-blue-900/30 text-blue-600 rounded-2xl">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h2 class="text-2xl font-extrabold text-gray-900 dark:text-white">A. Pendahuluan</h2>
                </div>
                <div class="prose dark:prose-invert max-w-none text-gray-600 dark:text-gray-400">
                    <p>Selamat datang di dokumentasi API LinkBayar Payment Gateway. Dokumentasi ini ditujukan untuk merchant yang ingin mengintegrasikan sistem pembayaran LinkBayar ke dalam website atau aplikasi mereka.</p>
                    
                </div>
            </div>
        </section>

        <!-- Section: Persiapan -->
        <section id="persiapan" class="bg-white dark:bg-gray-800 rounded-3xl border border-gray-100 dark:border-gray-700 shadow-sm overflow-hidden">
            <div class="p-8">
                <div class="flex items-center gap-4 mb-6">
                    <div class="p-3 bg-purple-100 dark:bg-purple-900/30 text-purple-600 rounded-2xl">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                        </svg>
                    </div>
                    <h2 class="text-2xl font-extrabold text-gray-900 dark:text-white">B. Persiapan</h2>
                </div>
                <div class="space-y-6">
                    <div class="bg-gray-50 dark:bg-gray-900/50 p-6 rounded-2xl border border-gray-100 dark:border-gray-700">
                        <h3 class="font-bold text-gray-900 dark:text-white mb-4">Langkah awal:</h3>
                        <ol class="space-y-3 list-decimal list-inside text-gray-600 dark:text-gray-400">
                            <li>Mendaftar akun di dashboard LinkBayar</li>
                            <li>Membuat project baru</li>
                            <li>Mencatat <span class="text-blue-600 font-bold uppercase">API Key</span> dari halaman detail project</li>
                            <li>Mengatur <span class="text-blue-600 font-bold uppercase">Webhook URL</span> di pengaturan project</li>
                        </ol>
                    </div>
                    <div class="grid md:grid-cols-2 gap-4">
                        <div class="p-5 border border-gray-100 dark:border-gray-700 rounded-2xl">
                            <span class="text-xs font-bold text-gray-400 uppercase">Base URL</span>
                            <div class="mt-1 font-mono text-sm text-blue-600">https://app.linkbayar.my.id</div>
                        </div>
                        <div class="p-5 border border-gray-100 dark:border-gray-700 rounded-2xl">
                            <span class="text-xs font-bold text-gray-400 uppercase">API Key</span>
                            <div class="mt-1 text-sm text-gray-600 dark:text-gray-400 italic">Tersedia di halaman detail project Anda</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section: Autentikasi -->
        <section id="autentikasi" class="bg-white dark:bg-gray-800 rounded-3xl border border-gray-100 dark:border-gray-700 shadow-sm overflow-hidden">
            <div class="p-8">
                <div class="flex items-center gap-4 mb-6">
                    <div class="p-3 bg-amber-100 dark:bg-amber-900/30 text-amber-600 rounded-2xl">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                        </svg>
                    </div>
                    <h2 class="text-2xl font-extrabold text-gray-900 dark:text-white">C. Autentikasi</h2>
                </div>
                <div class="space-y-6">
                    <p class="text-gray-600 dark:text-gray-400">Semua request API memerlukan <span class="font-bold">API Key</span> untuk autentikasi. Gunakan salah satu cara berikut:</p>
                    
                    <div class="space-y-4">
                        <div>
                            <h4 class="text-sm font-bold text-gray-900 dark:text-white mb-2">Cara 1 - Melalui Header (Disarankan)</h4>
                            <pre class="bg-gray-900 text-gray-100 p-4 rounded-xl text-sm font-mono overflow-auto">X-API-Key: api_key_anda</pre>
                        </div>
                        <div>
                            <h4 class="text-sm font-bold text-gray-900 dark:text-white mb-2">Cara 2 - Melalui Body JSON</h4>
                            <pre class="bg-gray-900 text-gray-100 p-4 rounded-xl text-sm font-mono overflow-auto">{
    "api_key": "api_key_anda",
    ...
}</pre>
                        </div>
                    </div>

                    <div class="p-4 bg-rose-50 dark:bg-rose-900/20 border border-rose-100 dark:border-rose-900/30 rounded-2xl text-rose-700 dark:text-rose-300 text-sm">
                        <p class="font-bold mb-1 italic">PENTING:</p>
                        <ul class="list-disc list-inside space-y-1">
                            <li>Setiap project memiliki API Key yang unik</li>
                            <li>Jangan letakkan API Key di kode frontend/client-side</li>
                            <li>Selalu panggil API dari server/backend Anda</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section: Daftar API -->
        <section id="daftar-api" class="bg-white dark:bg-gray-800 rounded-3xl border border-gray-100 dark:border-gray-700 shadow-sm overflow-hidden">
            <div class="p-8">
                <div class="flex items-center gap-4 mb-6">
                    <div class="p-3 bg-emerald-100 dark:bg-emerald-900/30 text-emerald-600 rounded-2xl">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l3 3-3 3m5 0h3M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h2 class="text-2xl font-extrabold text-gray-900 dark:text-white">D. Daftar API</h2>
                </div>
                
                <div class="space-y-12">
                    <!-- D.1 Create -->
                    <div class="border-t border-gray-100 dark:border-gray-700 pt-8 first:border-0 first:pt-0">
                        <div class="flex items-center gap-3 mb-6">
                            <span class="px-2.5 py-1 bg-blue-100 text-blue-700 rounded text-xs font-bold uppercase">POST</span>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white">D.1. Transaction Create (Membuat Transaksi)</h3>
                        </div>
                        <p class="text-gray-600 dark:text-gray-400 mb-6">Gunakan API ini untuk membuat transaksi pembayaran baru.</p>
                        
                        <div class="space-y-6">
                            <div class="bg-gray-900 rounded-2xl p-6 font-mono text-sm">
                                <div class="text-gray-400 mb-2">// URL</div>
                                <div class="text-emerald-400">https://app.linkbayar.my.id/api/transactioncreate/{method}</div>
                            </div>

                            <div class="overflow-hidden border border-gray-100 dark:border-gray-700 rounded-2xl">
                                <table class="w-full text-sm text-left">
                                    <thead class="bg-gray-50 dark:bg-gray-900/50 text-gray-500 uppercase text-[10px] font-bold">
                                        <tr>
                                            <th class="px-6 py-3">Nilai {method}</th>
                                            <th class="px-6 py-3">Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                                        <tr><td class="px-6 py-3 font-mono text-blue-600">qris</td><td class="px-6 py-3 dark:text-gray-300">QRIS (Scan QR Code)</td></tr>
                                        <tr><td class="px-6 py-3 font-mono text-blue-600">bri_va</td><td class="px-6 py-3 dark:text-gray-300">BRI Virtual Account</td></tr>
                                        <tr><td class="px-6 py-3 font-mono text-blue-600">bni_va</td><td class="px-6 py-3 dark:text-gray-300">BNI Virtual Account</td></tr>
                                        <tr><td class="px-6 py-3 font-mono text-blue-600">mandiri_va</td><td class="px-6 py-3 dark:text-gray-300">Mandiri Virtual Account</td></tr>
                                        <tr><td class="px-6 py-3 font-mono text-blue-600">bca_va</td><td class="px-6 py-3 dark:text-gray-300">BCA Virtual Account</td></tr>
                                        <tr><td class="px-6 py-3 font-mono text-blue-600">atm_bersama_va</td><td class="px-6 py-3 dark:text-gray-300">ATM Bersama Virtual Account</td></tr>
                                        <tr><td class="px-6 py-3 font-mono text-blue-600">bnc_va</td><td class="px-6 py-3 dark:text-gray-300">BNC Virtual Account</td></tr>
                                        <tr><td class="px-6 py-3 font-mono text-blue-600">cimb_niaga_va</td><td class="px-6 py-3 dark:text-gray-300">CIMB Niaga Virtual Account</td></tr>
                                        <tr><td class="px-6 py-3 font-mono text-blue-600">maybank_va</td><td class="px-6 py-3 dark:text-gray-300">Maybank Virtual Account</td></tr>
                                        <tr><td class="px-6 py-3 font-mono text-blue-600">permata_va</td><td class="px-6 py-3 dark:text-gray-300">Permata Virtual Account</td></tr>
                                        <tr><td class="px-6 py-3 font-mono text-blue-600">artha_graha_va</td><td class="px-6 py-3 dark:text-gray-300">Artha Graha Virtual Account</td></tr>
                                        <tr><td class="px-6 py-3 font-mono text-blue-600">sampoerna_va</td><td class="px-6 py-3 dark:text-gray-300">Sampoerna Virtual Account</td></tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="space-y-4">
                                <h4 class="font-bold text-gray-900 dark:text-white">Body (JSON)</h4>
                                <pre class="bg-gray-950 p-6 rounded-2xl font-mono text-xs text-emerald-400">{
    "project": "nama_project_anda",
    "order_id": "INV240910001",
    "amount": 99000,
    "api_key": "api_key_anda"
}</pre>
                            </div>

                            <div class="grid md:grid-cols-2 gap-4 text-xs">
                                <div class="p-4 border border-gray-100 dark:border-gray-700 rounded-xl">
                                    <div class="font-bold text-gray-900 dark:text-white mb-2 underline">Request Fields</div>
                                    <ul class="space-y-1 text-gray-600 dark:text-gray-400">
                                        <li><span class="font-mono text-blue-600">project</span>: Nama project Anda</li>
                                        <li><span class="font-mono text-blue-600">order_id</span>: ID pesanan unik</li>
                                        <li><span class="font-mono text-blue-600">amount</span>: Jumlah (Rupiah)</li>
                                        <li><span class="font-mono text-blue-600">api_key</span>: API Key project</li>
                                    </ul>
                                </div>
                                <div class="p-4 border border-gray-100 dark:border-gray-700 rounded-xl">
                                    <div class="font-bold text-gray-900 dark:text-white mb-2 underline">Response Fields</div>
                                    <ul class="space-y-1 text-gray-600 dark:text-gray-400">
                                        <li><span class="font-mono text-blue-600">payment_number</span>: No VA / QR String</li>
                                        <li><span class="font-mono text-blue-600">reference</span>: Ref transaksi</li>
                                        <li><span class="font-mono text-blue-600">total_payment</span>: Total + biaya</li>
                                        <li><span class="font-mono text-blue-600">expired_at</span>: Batas waktu</li>
                                    </ul>
                                </div>
                            </div>

                            <div x-data="{ lang: 'bash' }" class="rounded-2xl overflow-hidden border border-gray-100 dark:border-gray-700">
                                <div class="flex gap-1 bg-gray-50 dark:bg-gray-900/50 p-2 border-bottom border-gray-100 dark:border-gray-700">
                                    <button @click="lang = 'bash'" :class="lang === 'bash' ? 'bg-white dark:bg-gray-800 text-blue-600 shadow-sm' : 'text-gray-500 hover:text-gray-700'" class="px-4 py-1.5 rounded-lg text-xs font-bold transition-all">CURL</button>
                                    <button @click="lang = 'php'" :class="lang === 'php' ? 'bg-white dark:bg-gray-800 text-blue-600 shadow-sm' : 'text-gray-500 hover:text-gray-700'" class="px-4 py-1.5 rounded-lg text-xs font-bold transition-all">PHP</button>
                                    <button @click="lang = 'response'" :class="lang === 'response' ? 'bg-white dark:bg-gray-800 text-emerald-600 shadow-sm' : 'text-gray-500 hover:text-gray-700'" class="px-4 py-1.5 rounded-lg text-xs font-bold transition-all">RESPONSE</button>
                                </div>
                                <div class="bg-gray-950 p-6 font-mono text-xs overflow-auto">
                                    <pre x-show="lang === 'bash'" class="text-gray-300">curl -L -X POST 'https://app.linkbayar.my.id/api/transactioncreate/qris' \
-H 'Content-Type: application/json' \
-d '{
    "project": "depodomain",
    "order_id": "INV240910001",
    "amount": 99000,
    "api_key": "xxx123"
}'</pre>
                                    <pre x-show="lang === 'php'" class="text-gray-300">$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://app.linkbayar.my.id/api/transactioncreate/qris');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([
    'project'  => 'depodomain',
    'order_id' => 'INV240910001',
    'amount'   => 99000,
    'api_key'  => 'xxx123'
]));
$response = curl_exec($ch);
curl_close($ch);</pre>
                                    <pre x-show="lang === 'response'" class="text-emerald-400">{
    "payment": {
        "project": "depodomain",
        "order_id": "INV240910001",
        "amount": 99000,
        "fee": 0,
        "total_payment": 99000,
        "payment_method": "qris",
        "payment_number": "00020101021226...",
        "reference": "PK12345678",
        "expired_at": "2026-03-11T19:00:00+07:00"
    }
}</pre>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- D.2 Cancel -->
                    <div class="border-t border-gray-100 dark:border-gray-700 pt-8">
                        <div class="flex items-center gap-3 mb-6">
                            <span class="px-2.5 py-1 bg-rose-100 text-rose-700 rounded text-xs font-bold uppercase">POST</span>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white">D.2. Transaction Cancel (Membatalkan Transaksi)</h3>
                        </div>
                        <p class="text-gray-600 dark:text-gray-400 mb-6 font-medium italic underline decoration-rose-200">Hanya transaksi dengan status "pending" yang dapat dibatalkan.</p>
                        
                        <div class="space-y-6">
                            <div class="bg-gray-900 rounded-2xl p-6 font-mono text-sm">
                                <div class="text-emerald-400">https://app.linkbayar.my.id/api/transactioncancel</div>
                            </div>

                            <div x-data="{ lang: 'request' }" class="rounded-2xl overflow-hidden border border-gray-100 dark:border-gray-700">
                                <div class="flex gap-1 bg-gray-50 dark:bg-gray-900/50 p-2">
                                    <button @click="lang = 'request'" :class="lang === 'request' ? 'bg-white dark:bg-gray-800 text-blue-600 shadow-sm' : 'text-gray-500 hover:text-gray-700'" class="px-4 py-1.5 rounded-lg text-xs font-bold transition-all">JSON BODY</button>
                                    <button @click="lang = 'response'" :class="lang === 'response' ? 'bg-white dark:bg-gray-800 text-emerald-600 shadow-sm' : 'text-gray-500 hover:text-gray-700'" class="px-4 py-1.5 rounded-lg text-xs font-bold transition-all">RESPONSE</button>
                                </div>
                                <div class="bg-gray-950 p-6 font-mono text-xs overflow-auto">
                                    <pre x-show="lang === 'request'" class="text-gray-300">{
    "project": "depodomain",
    "order_id": "INV240910001",
    "amount": 99000,
    "api_key": "xxx123"
}</pre>
                                    <pre x-show="lang === 'response'" class="text-emerald-400">{
    "message": "Transaction cancelled"
}</pre>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- D.3 Detail -->
                    <div class="border-t border-gray-100 dark:border-gray-700 pt-8">
                        <div class="flex items-center gap-3 mb-6">
                            <span class="px-2.5 py-1 bg-amber-100 text-amber-700 rounded text-xs font-bold uppercase">GET</span>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white">D.3. Transaction Detail (Cek Status)</h3>
                        </div>
                        <p class="text-gray-600 dark:text-gray-400 mb-6">Gunakan API ini untuk mengecek detail dan status transaksi.</p>
                        
                        <div class="space-y-6">
                            <div class="bg-gray-900 rounded-2xl p-6 font-mono text-sm">
                                <div class="text-emerald-400">https://app.linkbayar.my.id/api/transactiondetail?order_id={id}</div>
                            </div>

                            <div x-data="{ lang: 'response' }" class="rounded-2xl overflow-hidden border border-gray-100 dark:border-gray-700">
                                <div class="flex gap-1 bg-gray-50 dark:bg-gray-900/50 p-2">
                                    <button @click="lang = 'response'" :class="lang === 'response' ? 'bg-white dark:bg-gray-800 text-emerald-600 shadow-sm' : 'text-gray-500 hover:text-gray-700'" class="px-4 py-1.5 rounded-lg text-xs font-bold transition-all">SUCCESS RESPONSE</button>
                                </div>
                                <div class="bg-gray-950 p-6 font-mono text-xs overflow-auto">
                                    <pre class="text-emerald-400">{
    "transaction": {
        "amount": 99000,
        "fee": 3500,
        "total_payment": 102500,
        "order_id": "INV240910001",
        "project": "depodomain",
        "status": "success",
        "payment_method": "bri_va",
        "completed_at": "2026-03-10T19:00:00+07:00"
    }
}</pre>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- D.4 Simulation -->
                    <div class="border-t border-gray-100 dark:border-gray-700 pt-8">
                        <div class="flex items-center gap-3 mb-6">
                            <span class="px-2.5 py-1 bg-indigo-100 text-indigo-700 rounded text-xs font-bold uppercase">POST</span>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white">D.4. Payment Simulation</h3>
                        </div>
                        <div class="p-4 bg-indigo-50 dark:bg-indigo-900/20 border border-indigo-100 dark:border-indigo-900/30 rounded-2xl text-indigo-700 dark:text-indigo-300 text-sm mb-6 font-bold">
                            HANYA tersedia untuk project dalam mode SANDBOX.
                        </div>
                        <div class="space-y-6">
                            <div class="bg-gray-900 rounded-2xl p-6 font-mono text-sm text-emerald-400">
                                https://app.linkbayar.my.id/api/paymentsimulation
                            </div>
                            <pre class="bg-gray-950 p-6 rounded-2xl font-mono text-xs text-gray-300">{
    "project": "depodomain",
    "order_id": "INV240910001",
    "amount": 99000,
    "api_key": "xxx123"
}</pre>
                        </div>
                    </div>

                    <!-- D.5 Get Methods -->
                    <div class="border-t border-gray-100 dark:border-gray-700 pt-8">
                        <div class="flex items-center gap-3 mb-6">
                            <span class="px-2.5 py-1 bg-teal-100 text-teal-700 rounded text-xs font-bold uppercase">GET</span>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white">D.5. Get Payment Methods</h3>
                        </div>
                        <p class="text-gray-600 dark:text-gray-400 mb-6">Ambil daftar metode pembayaran yang aktif beserta rincian biaya (fee) secara dinamis.</p>
                        <div class="bg-gray-900 rounded-2xl p-6 font-mono text-sm text-emerald-400 mb-6">
                            https://app.linkbayar.my.id/api/get_metode_pembayaran?amount=100000
                        </div>
                        <pre class="bg-gray-950 p-6 rounded-2xl font-mono text-xs text-emerald-400">{
    "methods": [
        {
            "payment_method": "qris",
            "payment_name": "QRIS",
            "payment_image": "https://app.linkbayar.my.id/images/qris.png",
            "total_fee": 1010
        },
        ...
    ]
}</pre>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section: Webhook -->
        <section id="webhook" class="bg-white dark:bg-gray-800 rounded-3xl border border-gray-100 dark:border-gray-700 shadow-sm overflow-hidden">
            <div class="p-8">
                <div class="flex items-center gap-4 mb-6">
                    <div class="p-3 bg-red-100 dark:bg-red-900/30 text-red-600 rounded-2xl">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                        </svg>
                    </div>
                    <h2 class="text-2xl font-extrabold text-gray-900 dark:text-white">E. Webhook Callback</h2>
                </div>
                
                <div class="space-y-8">
                    <div class="prose dark:prose-invert max-w-none text-gray-600 dark:text-gray-400">
                        <p>Webhook adalah cara sistem LinkBayar memberitahu server Anda bahwa ada perubahan status transaksi. Anda <span class="font-bold underline decoration-red-200">TIDAK perlu</span> memanggil API apapun untuk menerima notifikasi ini — sistem akan otomatis mengirimkannya.</p>
                    </div>

                    <div class="grid md:grid-cols-2 gap-6">
                        <div class="p-6 bg-gray-50 dark:bg-gray-900/50 rounded-2xl border border-gray-100 dark:border-gray-700">
                            <h4 class="font-bold text-gray-900 dark:text-white mb-3">E.1. Kapan Callback Dikirim?</h4>
                            <ul class="space-y-3 text-sm text-gray-600 dark:text-gray-400">
                                <li class="flex items-start gap-2">
                                    <div class="mt-1.5 w-1.5 h-1.5 rounded-full bg-emerald-500 shrink-0"></div>
                                    <span><span class="font-bold theme-text-emerald">Pembayaran Berhasil</span>: Pelanggan berhasil melakukan pembayaran.</span>
                                </li>
                                <li class="flex items-start gap-2">
                                    <div class="mt-1.5 w-1.5 h-1.5 rounded-full bg-rose-500 shrink-0"></div>
                                    <span><span class="font-bold theme-text-rose">Dibatalkan</span>: Transaksi dibatalkan via API atau sistem.</span>
                                </li>
                            </ul>
                        </div>
                        <div class="p-6 bg-gray-50 dark:bg-gray-900/50 rounded-2xl border border-gray-100 dark:border-gray-700">
                            <h4 class="font-bold text-gray-900 dark:text-white mb-3">E.2. Struktur Data</h4>
                            <pre class="bg-gray-950 p-4 rounded-xl font-mono text-[10px] text-emerald-400 overflow-auto">{
    "amount": 99000,
    "fee": 4500,
    "net_amount": 94500,
    "order_id": "INV240910001",
    "project": "depodomain",
    "status": "success",
    "payment_method": "qris",
    "completed_at": "2026-03-10T..."
}</pre>
                        </div>
                    </div>

                    <div x-data="{ lang: 'laravel' }" class="rounded-2xl overflow-hidden border border-gray-100 dark:border-gray-700">
                        <div class="bg-gray-50 dark:bg-gray-900/50 p-4 border-b border-gray-100 dark:border-gray-700">
                            <h4 class="font-bold text-gray-900 dark:text-white text-sm">E.3. Contoh Implementasi Webhook</h4>
                        </div>
                        <div class="flex gap-1 bg-gray-50 dark:bg-gray-900/50 p-2 border-b border-gray-100 dark:border-gray-700">
                            <button @click="lang = 'laravel'" :class="lang === 'laravel' ? 'bg-white dark:bg-gray-800 text-blue-600 shadow-sm' : 'text-gray-500 hover:text-gray-700'" class="px-4 py-1.5 rounded-lg text-xs font-bold transition-all">Laravel</button>
                            <button @click="lang = 'php'" :class="lang === 'php' ? 'bg-white dark:bg-gray-800 text-blue-600 shadow-sm' : 'text-gray-500 hover:text-gray-700'" class="px-4 py-1.5 rounded-lg text-xs font-bold transition-all">PHP Native</button>
                            <button @click="lang = 'node'" :class="lang === 'node' ? 'bg-white dark:bg-gray-800 text-blue-600 shadow-sm' : 'text-gray-500 hover:text-gray-700'" class="px-4 py-1.5 rounded-lg text-xs font-bold transition-all">Node.js</button>
                        </div>
                        <div class="bg-gray-950 p-6 font-mono text-xs overflow-auto">
                            <pre x-show="lang === 'laravel'" class="text-gray-300">public function handle(Request $request) {
    if ($request->input('status') === 'success') {
        DB::table('orders')->where('order_id', $request->input('order_id'))
            ->update(['status' => 'paid', 'paid_at' => now()]);
    }
    return response('OK', 200);
}</pre>
                            <pre x-show="lang === 'php'" class="text-gray-300">$payload = json_decode(file_get_contents('php://input'), true);
if ($payload['status'] === 'success') {
    // Process payment success in your database
}
http_response_code(200);
echo "OK";</pre>
                            <pre x-show="lang === 'node'" class="text-gray-300">app.post('/webhook', (req, res) => {
    const { order_id, status } = req.body;
    if (status === 'success') {
        // Update database
    }
    res.status(200).send('OK');
});</pre>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section: Status Transaksi -->
        <section id="status-transaksi" class="bg-white dark:bg-gray-800 rounded-3xl border border-gray-100 dark:border-gray-700 shadow-sm overflow-hidden">
            <div class="p-8">
                <div class="flex items-center gap-4 mb-6">
                    <div class="p-3 bg-blue-100 dark:bg-blue-900/30 text-blue-600 rounded-2xl">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h2 class="text-2xl font-extrabold text-gray-900 dark:text-white">F. Status Transaksi</h2>
                </div>
                
                <div class="space-y-8">
                    <div class="overflow-hidden border border-gray-100 dark:border-gray-700 rounded-2xl">
                        <table class="w-full text-sm text-left">
                            <thead class="bg-gray-50 dark:bg-gray-900/50 text-gray-500 uppercase text-[10px] font-bold">
                                <tr>
                                    <th class="px-6 py-4">Status</th>
                                    <th class="px-6 py-4">Keterangan</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 dark:divide-gray-700 text-gray-600 dark:text-gray-400">
                                <tr><td class="px-6 py-4"><span class="px-2 py-1 bg-amber-100 text-amber-700 rounded text-[10px] font-bold uppercase">pending</span></td><td class="px-6 py-4">Menunggu pembayaran pelanggan</td></tr>
                                <tr><td class="px-6 py-4"><span class="px-2 py-1 bg-emerald-100 text-emerald-700 rounded text-[10px] font-bold uppercase">success</span></td><td class="px-6 py-4">Pembayaran berhasil diterima</td></tr>
                                <tr><td class="px-6 py-4"><span class="px-2 py-1 bg-rose-100 text-rose-700 rounded text-[10px] font-bold uppercase">cancelled</span></td><td class="px-6 py-4">Dibatalkan oleh merchant/sistem</td></tr>
                                <tr><td class="px-6 py-4"><span class="px-2 py-1 bg-gray-100 text-gray-700 rounded text-[10px] font-bold uppercase">expired</span></td><td class="px-6 py-4">Melewati batas waktu pembayaran</td></tr>
                                <tr><td class="px-6 py-4"><span class="px-2 py-1 bg-red-100 text-red-700 rounded text-[10px] font-bold uppercase">failed</span></td><td class="px-6 py-4">Transaksi gagal diproses</td></tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="p-6 bg-gray-50 dark:bg-gray-900/50 rounded-2xl border border-dotted border-gray-300 dark:border-gray-600">
                        <h4 class="text-sm font-bold text-gray-900 dark:text-white mb-4">Diagram Alur Status:</h4>
                        <div class="flex flex-wrap items-center gap-4 text-xs font-mono">
                            <div class="px-3 py-2 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded shadow-sm">pending</div>
                            <svg class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" /></svg>
                            <div class="px-3 py-2 bg-emerald-50 dark:bg-emerald-900/30 text-emerald-700 border border-emerald-100 dark:border-emerald-800 rounded shadow-sm">success</div>
                            <div class="w-full md:w-auto h-px md:h-4 bg-gray-200 dark:bg-gray-700 md:hidden"></div>
                            <div class="px-3 py-2 bg-rose-50 dark:bg-rose-900/30 text-rose-700 border border-rose-100 dark:border-rose-800 rounded shadow-sm ml-auto md:ml-0">cancelled</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section: Biaya -->
        <section id="biaya" class="bg-white dark:bg-gray-800 rounded-3xl border border-gray-100 dark:border-gray-700 shadow-sm overflow-hidden">
            <div class="p-8">
                <div class="flex items-center gap-4 mb-6">
                    <div class="p-3 bg-amber-100 dark:bg-amber-900/30 text-amber-600 rounded-2xl">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h2 class="text-2xl font-extrabold text-gray-900 dark:text-white">K. Skema Biaya & Fee</h2>
                </div>
                
                <div class="overflow-hidden border border-gray-100 dark:border-gray-700 rounded-2xl">
                    <table class="w-full text-sm text-left">
                        <thead class="bg-gray-50 dark:bg-gray-900/50 text-gray-500 uppercase text-[10px] font-bold">
                            <tr>
                                <th class="px-6 py-4">Kategori</th>
                                <th class="px-6 py-4">Rumus Perhitungan Fee</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                            <tr><td class="px-6 py-4 font-bold dark:text-white">QRIS</td><td class="px-6 py-4 dark:text-gray-300">0,7% + Rp 310</td></tr>
                            <tr><td class="px-6 py-4 font-bold dark:text-white">BRI, BNI, VA Lainnya</td><td class="px-6 py-4 dark:text-gray-300">Rp 3.500 (Flat)</td></tr>
                            <tr><td class="px-6 py-4 font-bold dark:text-white">Mandiri VA</td><td class="px-6 py-4 dark:text-gray-300">Rp 4.500 (Flat)</td></tr>
                            <tr><td class="px-6 py-4 font-bold dark:text-white">BCA VA</td><td class="px-6 py-4 dark:text-gray-300">Rp 5.500 (Flat)</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <!-- Help Section -->
        <div class="bg-white dark:bg-gray-800 rounded-3xl p-8 border border-gray-100 dark:border-gray-700 shadow-sm text-center">
            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Butuh Bantuan Lebih Lanjut?</h3>
            <p class="text-gray-500 dark:text-gray-400 mb-6">Tim support kami siap membantu integrasi Anda.</p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="mailto:support@LinkBayar.com" class="px-6 py-3 bg-blue-600 text-white rounded-xl font-bold hover:bg-blue-700 transition-colors">Email: support@LinkBayar.com</a>
                <a href="https://app.LinkBayar.com" class="px-6 py-3 border border-gray-200 dark:border-gray-700 rounded-xl font-bold hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors dark:text-white">Visit: app.LinkBayar.com</a>
            </div>
        </div>
    </div>
</x-app-layout>
