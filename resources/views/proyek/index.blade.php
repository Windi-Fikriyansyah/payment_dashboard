<x-app-layout>
    <x-slot name="header">
        Proyek
    </x-slot>

    <div class="space-y-6" x-data="{ showModal: {{ $errors->any() ? 'true' : 'false' }}, botWhatsapp: false }">
        @if (session('success'))
            <div x-data="{ show: true }" x-show="show" class="p-4 mb-4 text-sm text-emerald-800 rounded-lg bg-emerald-50 dark:bg-gray-800 dark:text-emerald-400 relative" role="alert">
                <span class="font-medium">Berhasil!</span> {{ session('success') }}
                <button @click="show = false" class="absolute top-4 right-4 text-emerald-800 dark:text-emerald-400">&times;</button>
            </div>
        @endif

        <!-- Warning Information Card / Tutorial -->
        <div class="bg-rose-500 rounded-2xl shadow-sm border border-rose-600 p-5 flex items-start gap-4">
            <div class="flex-shrink-0 bg-white/20 p-2 rounded-xl">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div class="flex-1 text-white">
                <h3 class="font-bold text-lg mb-2">Panduan Pengaturan Proyek</h3>
                <ul class="list-disc list-inside text-white/90 text-sm leading-relaxed space-y-1 block">
                    <li><strong>Mengaktifkan Bot WhatsApp:</strong> <a href="{{ route('tutorial') }}" class="font-bold underline hover:text-white transition-colors">tutorial disini</a></li>
                    <li><strong>Ganti Mode Sandbox/Production:</strong> <a href="{{ route('tutorial') }}" class="font-bold underline hover:text-white transition-colors">tutorial disini</a></li>
                    <li><strong>Ganti Fee ditanggung Customer/Merchant:</strong> <a href="{{ route('tutorial') }}" class="font-bold underline hover:text-white transition-colors">tutorial disini</a></li>
                </ul>
            </div>
        </div>

        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Daftar Proyek</h1>
            <button @click="showModal = true" class="px-4 py-2 bg-blue-600 text-white rounded-xl font-bold text-sm shadow-sm hover:bg-blue-700 transition-colors">
                + Tambah Proyek
            </button>
        </div>

        <!-- DataTable Container -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden text-sm">
            <div class="p-6">
                <table id="projects-table" class="display responsive nowrap w-full">
                    <thead>
                        <tr>
                            <th class="px-6 py-4 font-bold">Nama</th>
                            <th class="px-6 py-4 font-bold">Slug</th>
                            <th class="px-6 py-4 font-bold">Mode</th>
                            <th class="px-6 py-4 font-bold">Total Transaksi</th>
                            <th class="px-6 py-4 font-bold">Status</th>
                            <th class="px-6 py-4 font-bold text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Yajra Data -->
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Modal Create Project -->
        <div x-show="showModal" 
             style="display: none;"
             class="fixed inset-0 z-50 overflow-y-auto" 
             aria-labelledby="modal-title" 
             role="dialog" 
             aria-modal="true">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div x-show="showModal" 
                     x-transition:enter="ease-out duration-300" 
                     x-transition:enter-start="opacity-0" 
                     x-transition:enter-end="opacity-100" 
                     x-transition:leave="ease-in duration-200" 
                     x-transition:leave-start="opacity-100" 
                     x-transition:leave-end="opacity-0" 
                     class="fixed inset-0 bg-gray-900/75 backdrop-blur-sm transition-opacity" 
                     @click="showModal = false"
                     aria-hidden="true"></div>

                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                <div x-show="showModal" 
                     x-transition:enter="ease-out duration-300" 
                     x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
                     x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" 
                     x-transition:leave="ease-in duration-200" 
                     x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" 
                     x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
                     class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg w-full border border-gray-100 dark:border-gray-700">
                    
                    <div class="px-6 py-5 border-b border-gray-100 dark:border-gray-700 flex justify-between items-center bg-gray-50 dark:bg-gray-800/50">
                        <h3 class="text-lg leading-6 font-bold text-gray-900 dark:text-white" id="modal-title">
                            Tambah Proyek Baru
                        </h3>
                        <button @click="showModal = false" class="text-gray-400 hover:text-gray-500 focus:outline-none">
                            <span class="sr-only">Tutup</span>
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <form action="{{ route('proyek.store') }}" method="POST">
                        @csrf
                        <div class="p-6 space-y-5">
                            <div>
                                <label for="nama" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Proyek <span class="text-rose-500">*</span></label>
                                <input type="text" name="nama" id="nama" value="{{ old('nama') }}" required class="mt-2 block w-full bg-gray-50 dark:bg-gray-900/50 border border-gray-300 dark:border-gray-600 rounded-xl shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm text-gray-900 dark:text-white px-4 py-3" placeholder="Contoh: Toko Online Saya">
                                <x-input-error :messages="$errors->get('nama')" class="mt-2" />
                            </div>

                            <div>
                                <label for="webhook_url" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Webhook URL <span class="text-gray-400 font-normal">(Opsional)</span></label>
                                <input type="url" name="webhook_url" id="webhook_url" value="{{ old('webhook_url') }}" class="mt-2 block w-full bg-gray-50 dark:bg-gray-900/50 border border-gray-300 dark:border-gray-600 rounded-xl shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm text-gray-900 dark:text-white px-4 py-3" placeholder="https://domain.com/webhook">
                                <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">URL ini akan menerima notifikasi transaksi secara otomatis.</p>
                                <x-input-error :messages="$errors->get('webhook_url')" class="mt-2" />
                            </div>

                            <div class="grid grid-cols-1 gap-5">
                                <div>
                                    <label for="bot_whatsapp" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Bot WhatsApp</label>
                                    <select name="bot_whatsapp" id="bot_whatsapp" x-model="botWhatsapp" class="mt-2 block w-full bg-gray-50 dark:bg-gray-900/50 border border-gray-300 dark:border-gray-600 rounded-xl shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm text-gray-900 dark:text-white px-4 py-3">
                                        <option value="0">Tidak</option>
                                        <option value="1">Ya</option>
                                    </select>
                                </div>

                                <div x-show="botWhatsapp == '1'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 transform -translate-y-2" x-transition:enter-end="opacity-100 transform translate-y-0">
                                    <label for="no_whatsapp" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nomor WhatsApp (Awali dengan 62) <span class="text-rose-500">*</span></label>
                                    <input type="text" name="no_whatsapp" id="no_whatsapp" value="{{ old('no_whatsapp') }}" class="mt-2 block w-full bg-gray-50 dark:bg-gray-900/50 border border-gray-300 dark:border-gray-600 rounded-xl shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm text-gray-900 dark:text-white px-4 py-3" placeholder="Contoh: 628123456789">
                                    <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">Pastikan nomor dimulai dengan <strong>62</strong>.</p>
                                    <x-input-error :messages="$errors->get('no_whatsapp')" class="mt-2" />
                                </div>
                            </div>
                        </div>
                        
                        <div class="px-6 py-4 bg-gray-50 dark:bg-gray-800/50 border-t border-gray-100 dark:border-gray-700 flex justify-end gap-3">
                            <button type="button" @click="showModal = false" class="px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 rounded-xl text-sm font-bold shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                                Batal
                            </button>
                            <button type="submit" class="px-4 py-2 bg-blue-600 border border-transparent rounded-xl shadow-sm text-sm font-bold text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                                Simpan Proyek
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- DataTables Styling -->
    <style>
        .dataTables_wrapper .dataTables_length select {
            @apply bg-white border border-gray-200 text-gray-900 text-sm rounded-xl focus:ring-blue-500 focus:border-blue-500 py-1.5 pl-3 dark:bg-gray-800 dark:border-gray-700 dark:placeholder-gray-400 dark:text-white shadow-sm transition-all;
            padding-right: 1.8rem !important;
            min-width: 3.5rem !important;
            background-position: right 0.4rem center !important;
            outline: none;
        }

        .dataTables_wrapper .dataTables_filter input {
            @apply bg-white border border-gray-200 text-gray-900 text-sm rounded-xl focus:ring-blue-500 focus:border-blue-500 p-2 ml-2 dark:bg-gray-800 dark:border-gray-700 dark:placeholder-gray-400 dark:text-white shadow-sm transition-all;
            outline: none;
        }

        .dataTables_wrapper .dataTables_length,
        .dataTables_wrapper .dataTables_filter {
            @apply text-sm text-gray-600 dark:text-gray-400;
            margin-bottom: 20px !important;
        }

        @media (max-width: 640px) {
            .dataTables_wrapper .dataTables_filter {
                text-align: left !important;
                float: none !important;
            }
            .dataTables_wrapper .dataTables_filter input {
                width: 100% !important;
                margin-left: 0 !important;
                margin-top: 8px !important;
            }
        }

        table.dataTable {
            margin-top: 20px !important;
            border-spacing: 0;
            clear: both;
        }
    </style>

    <!-- DataTables Script -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#projects-table').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: '{{ route("proyek.data") }}',
                columns: [
                    { 
                        data: 'nama', 
                        name: 'nama',
                        render: function(data) {
                            return `<span class="font-bold text-gray-900 dark:text-white">${data}</span>`;
                        }
                    },
                    { 
                        data: 'slug', 
                        name: 'slug',
                        render: function(data) {
                            return `<span class="px-2.5 py-1 text-xs font-mono font-medium text-gray-600 bg-gray-100 border border-gray-200 rounded-lg dark:bg-gray-800 dark:text-gray-400 dark:border-gray-700">${data}</span>`;
                        }
                    },
                    { 
                        data: 'mode', 
                        name: 'mode',
                        render: function(data) {
                            var color = data === 'Production' ? 'rose' : 'blue';
                            return `<span class="px-2 py-1 bg-${color}-100 text-${color}-600 rounded-lg text-xs font-bold">${data}</span>`;
                        }
                    },
                    { 
                        data: 'total_transaksi_format', 
                        name: 'total_transaksi',
                        render: function(data) {
                            return `<span class="font-semibold text-gray-800 dark:text-gray-200">${data}</span>`;
                        }
                    },
                    { 
                        data: 'status', 
                        name: 'status',
                        render: function(data) {
                            var color = data === 'Aktif' ? 'emerald' : 'rose';
                            return `<span class="px-2 py-1 bg-${color}-100 text-${color}-600 rounded-lg text-xs font-bold">${data}</span>`;
                        }
                    },
                    { data: 'aksi', name: 'aksi', orderable: false, searchable: false, className: 'text-center' }
                ]
            });

            // SweetAlert for Delete Action
            $('#projects-table').on('click', '.btn-delete', function(e) {
                e.preventDefault();
                let form = $(this).closest('form');
                
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Proyek ini akan dihapus permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#ef4444',
                    cancelButtonColor: '#6b7280',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal',
                    customClass: {
                        confirmButton: 'px-4 py-2 bg-rose-500 text-white rounded-lg font-bold mx-2 hover:bg-rose-600',
                        cancelButton: 'px-4 py-2 bg-gray-500 text-white rounded-lg font-bold mx-2 hover:bg-gray-600'
                    },
                    buttonsStyling: false
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</x-app-layout>
