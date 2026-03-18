<x-app-layout>
    <x-slot name="header">
        Detail Proyek: {{ $project->nama }}
    </x-slot>

    <div class="space-y-8 animate-in fade-in slide-in-from-bottom-4 duration-700" x-data="{ showEditModal: {{ $errors->any() ? 'true' : 'false' }}, showApiKey: false, apiKeyCopied: false, botWhatsapp: {{ old('bot_whatsapp', $project->bot_whatsapp) ? 'true' : 'false' }} }">
        @if (session('success'))
            <div x-data="{ show: true }" x-show="show" class="p-4 mb-4 text-sm text-emerald-800 rounded-lg bg-emerald-50 dark:bg-gray-800 dark:text-emerald-400 relative" role="alert">
                <span class="font-medium">Berhasil!</span> {{ session('success') }}
                <button @click="show = false" class="absolute top-4 right-4 text-emerald-800 dark:text-emerald-400">&times;</button>
            </div>
        @endif

        <div class="flex justify-between items-start">
            <h1 class="text-3xl font-extrabold text-gray-900 dark:text-white">Detail Proyek</h1>
            <div class="flex items-center gap-3">
                <button @click="showEditModal = true" class="px-5 py-2.5 bg-blue-600 text-white rounded-xl font-bold text-sm shadow-sm hover:bg-blue-700 transition">
                    Edit Proyek
                </button>
                <a href="{{ route('proyek.index') }}" class="px-5 py-2.5 bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300 rounded-xl font-bold text-sm hover:bg-gray-200 dark:hover:bg-gray-700 transition">
                    ← Kembali
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Basic Info Card -->
            <div class="bg-white dark:bg-gray-800 p-8 rounded-3xl border border-gray-100 dark:border-gray-700 shadow-xl shadow-gray-200/20 dark:shadow-none space-y-6">
                <div class="flex justify-between items-center border-b border-gray-100 dark:border-gray-700 pb-4">
                    <h2 class="text-xl font-bold text-gray-800 dark:text-white flex items-center gap-2">
                        <svg class="w-6 h-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Informasi Umum
                    </h2>
                    <span class="px-3 py-1 bg-{{ $project->status === 'Aktif' ? 'emerald' : 'rose' }}-100 text-{{ $project->status === 'Aktif' ? 'emerald' : 'rose' }}-600 rounded-lg text-sm font-bold">
                        {{ $project->status }}
                    </span>
                </div>

                <div class="grid grid-cols-1 gap-5">
                    <div class="flex justify-between items-center">
                        <span class="text-gray-500 font-medium whitespace-nowrap">Nama:</span>
                        <span class="text-gray-900 dark:text-white font-bold ml-4 break-all text-right">{{ $project->nama }}</span>
                    </div>
                    <div class="flex justify-between items-center bg-gray-50 dark:bg-gray-900/50 p-3 rounded-2xl border border-gray-100 dark:border-gray-700 my-2">
                        <span class="text-gray-500 font-medium whitespace-nowrap">Aktif:</span>
                        <div class="flex items-center gap-3">
                            <span class="text-sm font-bold {{ $project->status === 'Aktif' ? 'text-emerald-600' : 'text-rose-600' }}">
                                {{ $project->status === 'Aktif' ? 'Ya' : 'Tidak' }}
                            </span>
                    <form action="{{ route('proyek.update', $project->encrypted_id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="status" value="{{ $project->status === 'Aktif' ? 'Nonaktif' : 'Aktif' }}">
                                <button type="submit" class="text-xs text-white bg-gray-900 dark:bg-gray-100 dark:text-gray-900 px-3 py-1.5 rounded-lg font-bold hover:scale-105 transition-transform active:scale-95 shadow-md">
                                    Switch
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="flex justify-between items-center bg-gray-50 dark:bg-gray-900/50 p-3 rounded-2xl border border-gray-100 dark:border-gray-700 my-2">
                        <span class="text-gray-500 font-medium whitespace-nowrap">Mode:</span>
                        <div class="flex items-center gap-3">
                            <span class="text-sm font-bold {{ $project->mode === 'production' ? 'text-rose-600' : 'text-blue-600' }}">
                                {{ $project->mode }}
                            </span>
                    <form action="{{ route('proyek.update', $project->encrypted_id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="mode" value="{{ $project->mode === 'production' ? 'sandbox' : 'production' }}">
                                <button type="submit" class="text-xs text-white bg-gray-900 dark:bg-gray-100 dark:text-gray-900 px-3 py-1.5 rounded-lg font-bold hover:scale-105 transition-transform active:scale-95 shadow-md">
                                    Switch
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-500 font-medium whitespace-nowrap">Total Transaksi:</span>
                        <span class="text-gray-900 dark:text-white font-bold">Rp {{ number_format($project->total_transaksi, 0, ',', '.') }}</span>
                    </div>
                    <!-- <div class="flex justify-between items-center">
                        <span class="text-gray-500 font-medium whitespace-nowrap">Saldo Tertunda:</span>
                        <span class="text-gray-900 dark:text-white font-bold">Rp {{ number_format($project->saldo_tertunda, 0, ',', '.') }}</span>
                    </div> -->
                    <div class="flex justify-between items-center bg-gray-50 dark:bg-gray-900/50 p-3 rounded-2xl border border-gray-100 dark:border-gray-700 my-2">
                        <span class="text-gray-500 font-medium whitespace-nowrap">Fee By Merchant:</span>
                        <div class="flex items-center gap-3">
                            <span class="text-sm font-bold {{ $project->fee_by_merchant ? 'text-emerald-600' : 'text-gray-500' }}">
                                {{ $project->fee_by_merchant ? 'Ya' : 'Tidak' }}
                            </span>
                    <form action="{{ route('proyek.update', $project->encrypted_id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="fee_by_merchant" value="{{ $project->fee_by_merchant ? 0 : 1 }}">
                                <button type="submit" class="text-xs text-white bg-gray-900 dark:bg-gray-100 dark:text-gray-900 px-3 py-1.5 rounded-lg font-bold hover:scale-105 transition-transform active:scale-95 shadow-md">
                                    Switch
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="flex flex-col gap-2">
                        <span class="text-gray-500 font-medium">Webhook URL:</span>
                        <div class="p-3 bg-gray-50 dark:bg-gray-900/50 border border-gray-200 dark:border-gray-700 rounded-xl text-sm break-all font-mono">
                            {{ $project->webhook_url ?: 'N/A' }}
                        </div>
                    </div>
                    <div class="flex justify-between items-center border-t border-gray-100 dark:border-gray-700 pt-4 mt-2">
                        <span class="text-gray-500 font-medium whitespace-nowrap">Bot WhatsApp:</span>
                        <div class="flex items-center gap-3">
                            <span class="text-sm font-bold {{ $project->bot_whatsapp ? 'text-emerald-600' : 'text-gray-500' }}">
                                {{ $project->bot_whatsapp ? 'Aktif' : 'Nonaktif' }}
                            </span>
                    <form action="{{ route('proyek.update', $project->encrypted_id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="bot_whatsapp_toggle" value="1">
                                <input type="hidden" name="bot_whatsapp" value="{{ $project->bot_whatsapp ? 0 : 1 }}">
                                <button type="submit" class="text-xs text-white bg-gray-900 dark:bg-gray-100 dark:text-gray-900 px-3 py-1.5 rounded-lg font-bold hover:scale-105 transition-transform active:scale-95 shadow-md">
                                    Switch
                                </button>
                            </form>
                        </div>
                    </div>
                    @if($project->bot_whatsapp)
                    <div class="flex justify-between items-center bg-emerald-50 dark:bg-emerald-900/20 p-3 rounded-2xl border border-emerald-100 dark:border-emerald-800/50 my-2">
                        <span class="text-emerald-700 dark:text-emerald-400 font-medium">No. WhatsApp:</span>
                        <span class="text-emerald-800 dark:text-emerald-300 font-bold ml-4">{{ $project->no_whatsapp }}</span>
                    </div>
                    @endif
                    <div class="flex justify-between items-center border-t border-gray-100 dark:border-gray-700 pt-4 mt-2">
                        <span class="text-gray-500 font-medium">Kirim Notifikasi Ke:</span>
                        <span class="text-gray-900 dark:text-white font-bold">{{ $project->notifikasi_ke }}</span>
                    </div>
                </div>
            </div>

            <!-- Integration Card -->
            <div class="bg-gray-900 text-white p-8 rounded-3xl shadow-2xl space-y-8 relative overflow-hidden group">
                <div class="absolute -right-20 -top-20 w-64 h-64 bg-blue-500/20 rounded-full blur-3xl pointer-events-none group-hover:scale-110 transition-transform duration-1000"></div>
                
                <h2 class="text-2xl font-bold flex items-center gap-2 relative z-10">
                    <svg class="w-8 h-8 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                    </svg>
                    Integrasi
                </h2>

                <div class="space-y-6 relative z-10">
                    <div class="space-y-2">
                        <label class="text-sm text-gray-400 font-bold uppercase tracking-widest">Slug</label>
                        <div class="text-xl font-mono p-4 bg-white/5 border border-white/10 rounded-2xl flex items-center justify-between group/slug">
                            <span>{{ $project->slug }}</span>
                            <button class="opacity-0 group-hover/slug:opacity-100 transition-opacity text-blue-500" onclick="navigator.clipboard.writeText('{{ $project->slug }}')">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="text-sm text-gray-400 font-bold uppercase tracking-widest">API Key</label>
                        <div class="space-y-3">
                            <div class="text-xs font-mono p-4 bg-blue-500/10 border border-blue-500/30 rounded-2xl flex flex-wrap items-center justify-between gap-2 overflow-hidden group/apikey relative">
                                <span class="break-all" x-text="showApiKey ? '{{ $project->api_key }}' : '****************************************'">****************************************</span>
                                <div class="flex items-center gap-2 opacity-0 group-hover/apikey:opacity-100 transition-opacity">
                                    <button class="text-blue-400 hover:text-blue-300" @click="showApiKey = !showApiKey" title="Lihat API Key">
                                        <!-- Eye Open Icon -->
                                        <svg x-show="!showApiKey" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.522 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        <!-- Eye Closed Icon -->
                                        <svg x-show="showApiKey" style="display: none;" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                                        </svg>
                                    </button>
                                    <button class="text-blue-400 hover:text-blue-300" @click="navigator.clipboard.writeText('{{ $project->api_key }}'); apiKeyCopied = true; setTimeout(() => apiKeyCopied = false, 2000)" title="Salin API Key">
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <div class="flex items-center justify-between">
                                <p class="text-[10px] text-gray-500 italic">API Key otomatis berubah saat beralih ke Mode production untuk keamanan tambahan.</p>
                                <span x-show="apiKeyCopied" x-transition class="text-xs text-emerald-400 font-bold ml-2">Berhasil disalin!</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="pt-6 relative z-10 border-t border-white/5 flex flex-col gap-4">
                    <p class="text-sm text-gray-400">Pastikan untuk tidak membagikan API Key Anda kepada publik. Mode production menggunakan kredensial yang berbeda dengan Mode sandbox.</p>
                    
                    <a href="{{ route('proyek.pembayaran', $project->encrypted_id) }}" class="inline-flex items-center justify-center gap-2 w-full px-6 py-4 bg-white text-gray-900 rounded-2xl font-bold hover:bg-blue-500 hover:text-white transition-all transform hover:scale-[1.02] active:scale-[0.98] shadow-lg">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                        </svg>
                        Atur Metode Pembayaran
                    </a>
                </div>
            </div>
        </div>

        <!-- Modal Edit Project -->
        <div x-show="showEditModal" 
             style="display: none;"
             class="fixed inset-0 z-[100] overflow-y-auto" 
             aria-labelledby="modal-title" 
             role="dialog" 
             aria-modal="true">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div x-show="showEditModal" 
                     x-transition:enter="ease-out duration-300" 
                     x-transition:enter-start="opacity-0" 
                     x-transition:enter-end="opacity-100" 
                     x-transition:leave="ease-in duration-200" 
                     x-transition:leave-start="opacity-100" 
                     x-transition:leave-end="opacity-0" 
                     class="fixed inset-0 bg-gray-900/75 backdrop-blur-sm transition-opacity" 
                     @click="showEditModal = false"
                     aria-hidden="true"></div>

                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                <div x-show="showEditModal" 
                     x-transition:enter="ease-out duration-300" 
                     x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
                     x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" 
                     x-transition:leave="ease-in duration-200" 
                     x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" 
                     x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
                     class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-xl w-full border border-gray-100 dark:border-gray-700">
                    
                    <div class="px-6 py-5 border-b border-gray-100 dark:border-gray-700 flex justify-between items-center bg-gray-50 dark:bg-gray-800/50">
                        <h3 class="text-lg leading-6 font-bold text-gray-900 dark:text-white" id="modal-title">
                            Edit Proyek
                        </h3>
                        <button @click="showEditModal = false" class="text-gray-400 hover:text-gray-500 focus:outline-none">
                            <span class="sr-only">Tutup</span>
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <form action="{{ route('proyek.update', $project->encrypted_id) }}" method="POST">
                        @csrf
                        <div class="p-6 space-y-5 max-h-[60vh] overflow-y-auto">
                            <div>
                                <label for="nama_edit" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama <span class="text-rose-500">*</span></label>
                                <input type="text" name="nama" id="nama_edit" value="{{ old('nama', $project->nama) }}" required class="mt-2 block w-full bg-gray-50 dark:bg-gray-900/50 border border-gray-300 dark:border-gray-600 rounded-xl shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm text-gray-900 dark:text-white px-4 py-3">
                                <x-input-error :messages="$errors->get('nama')" class="mt-2" />
                            </div>

                            <div class="grid grid-cols-2 gap-5">
                                <div>
                                    <label for="status_edit" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Aktif</label>
                                    <select name="status" id="status_edit" class="mt-2 block w-full bg-gray-50 dark:bg-gray-900/50 border border-gray-300 dark:border-gray-600 rounded-xl shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm text-gray-900 dark:text-white px-4 py-3">
                                        <option value="Aktif" {{ $project->status === 'Aktif' ? 'selected' : '' }}>Ya</option>
                                        <option value="Nonaktif" {{ $project->status === 'Nonaktif' ? 'selected' : '' }}>Tidak</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="mode_edit" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Mode</label>
                                    <select name="mode" id="mode_edit" class="mt-2 block w-full bg-gray-50 dark:bg-gray-900/50 border border-gray-300 dark:border-gray-600 rounded-xl shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm text-gray-900 dark:text-white px-4 py-3">
                                        <option value="sandbox" {{ $project->mode === 'sandbox' ? 'selected' : '' }}>sandbox</option>
                                        <option value="production" {{ $project->mode === 'production' ? 'selected' : '' }}>production</option>
                                    </select>
                                </div>
                            </div>

                            <div>
                                <label for="webhook_url_edit" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Webhook URL</label>
                                <input type="url" name="webhook_url" id="webhook_url_edit" value="{{ old('webhook_url', $project->webhook_url) }}" class="mt-2 block w-full bg-gray-50 dark:bg-gray-900/50 border border-gray-300 dark:border-gray-600 rounded-xl shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm text-gray-900 dark:text-white px-4 py-3" placeholder="https://domain.com/webhook">
                            </div>

                            <div>
                                <label for="fee_by_merchant_edit" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Fee By Merchant</label>
                                <select name="fee_by_merchant" id="fee_by_merchant_edit" class="mt-2 block w-full bg-gray-50 dark:bg-gray-900/50 border border-gray-300 dark:border-gray-600 rounded-xl shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm text-gray-900 dark:text-white px-4 py-3">
                                    <option value="0" {{ !$project->fee_by_merchant ? 'selected' : '' }}>Tidak</option>
                                    <option value="1" {{ $project->fee_by_merchant ? 'selected' : '' }}>Ya</option>
                                </select>
                                <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">Aktifkan jika Anda ingin menanggung fee transaksi (defaultnya ditanggung oleh customer).</p>
                            </div>

                            <div>
                                <label for="bot_whatsapp_edit" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Bot WhatsApp</label>
                                <select name="bot_whatsapp" id="bot_whatsapp_edit" x-model="botWhatsapp" class="mt-2 block w-full bg-gray-50 dark:bg-gray-900/50 border border-gray-300 dark:border-gray-600 rounded-xl shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm text-gray-900 dark:text-white px-4 py-3">
                                    <option value="0">Tidak</option>
                                    <option value="1">Ya</option>
                                </select>
                            </div>

                            <div x-show="botWhatsapp == '1'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 transform -translate-y-2" x-transition:enter-end="opacity-100 transform translate-y-0">
                                <label for="no_whatsapp_edit" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nomor WhatsApp (Awali dengan 62) <span class="text-rose-500">*</span></label>
                                <input type="text" name="no_whatsapp" id="no_whatsapp_edit" value="{{ old('no_whatsapp', $project->no_whatsapp) }}" class="mt-2 block w-full bg-gray-50 dark:bg-gray-900/50 border border-gray-300 dark:border-gray-600 rounded-xl shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm text-gray-900 dark:text-white px-4 py-3" placeholder="Contoh: 628123456789">
                                <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">Pastikan nomor dimulai dengan <strong>62</strong> tanpa simbol + atau spasi.</p>
                                <x-input-error :messages="$errors->get('no_whatsapp')" class="mt-2" />
                            </div>

                            <div>
                                <label for="notifikasi_ke_edit" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Kirim Notifikasi Ke</label>
                                <input type="text" name="notifikasi_ke" id="notifikasi_ke_edit" value="{{ old('notifikasi_ke', $project->notifikasi_ke) }}" class="mt-2 block w-full bg-gray-50 dark:bg-gray-900/50 border border-gray-300 dark:border-gray-600 rounded-xl shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm text-gray-900 dark:text-white px-4 py-3" placeholder="your@email.com">
                                <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">Kosongkan jika tidak ingin menerima notifikasi.</p>
                            </div>
                        </div>
                        
                        <div class="px-6 py-4 bg-gray-50 dark:bg-gray-800/50 border-t border-gray-100 dark:border-gray-700 flex justify-end gap-3">
                            <button type="button" @click="showEditModal = false" class="px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 rounded-xl text-sm font-bold shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                                Batal
                            </button>
                            <button type="submit" class="px-4 py-2 bg-blue-600 border border-transparent rounded-xl shadow-sm text-sm font-bold text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
