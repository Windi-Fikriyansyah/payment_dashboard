<x-app-layout>
    <x-slot name="header">
        Penarikan
    </x-slot>

    <div class="space-y-6">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Riwayat Penarikan</h1>
           
                <button id="btn-request-penarikan"
                    class="flex items-center gap-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-xl shadow-md transition-all duration-200 active:scale-95">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Request Penarikan
                </button>
        </div>

        <!-- Warning Information Card -->
        <div class="bg-rose-500 rounded-2xl shadow-sm border border-rose-600 p-5 flex items-start gap-4">
            <div class="flex-shrink-0 bg-white/20 p-2 rounded-xl">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div class="flex-1 text-white">
                <h3 class="font-bold text-lg mb-1">Informasi Penarikan</h3>
                <div class="text-white/90 text-sm leading-relaxed space-y-1">
                    <p>• Setiap penarikan dikenakan biaya admin sebesar <strong>Rp 6.500</strong>.</p>
                    <p>• Penarikan diproses setiap malam pukul <strong>18.00 WIB - 19.00 WIB</strong>. Jika penarikan dilakukan setelah jam tersebut, maka akan diproses keesokan harinya.</p>
                </div>
            </div>
        </div>

        <!-- DataTable Container -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden text-sm">
            <div class="p-6">
                <table id="penarikan-table" class="display responsive nowrap w-full text-left text-gray-500 dark:text-gray-400">
                    <thead class="bg-gray-50 dark:bg-gray-900/50 text-gray-700 dark:text-gray-300 uppercase text-xs">
                        <tr>
                            <th class="px-6 py-4 font-bold">Tanggal</th>
                            <th class="px-6 py-4 font-bold">Status</th>
                            <th class="px-6 py-4 font-bold">Jumlah</th>
                            <th class="px-6 py-4 font-bold">Fee</th>
                            <th class="px-6 py-4 font-bold">Total Diterima</th>
                            <th class="px-6 py-4 font-bold">Penerima</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Request Penarikan -->
    <div id="modal-request" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500/75 backdrop-blur-sm transition-opacity" id="close-modal-bg"></div>

            <div class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full border border-gray-100 dark:border-gray-700">
                <form id="form-penarikan">
                    @csrf
                    <div class="px-6 py-5 border-b border-gray-100 dark:border-gray-700 flex justify-between items-center bg-gray-50 dark:bg-gray-800/50">
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white">Request Penarikan</h3>
                        <button type="button" class="close-modal text-gray-400 hover:text-gray-500"><svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg></button>
                    </div>

                    <div class="p-6 space-y-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Pilih Proyek</label>
                            <select name="project_id" id="project_id" class="select2-modal" required>
                                <option value="">Pilih Proyek...</option>
                                @foreach($projects as $project)
                                    <option value="{{ $project->id }}" data-saldo="{{ $project->saldo }}">
                                        {{ $project->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Saldo Tersedia</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500 font-bold text-sm">Rp</span>
                                <input type="text" id="display_saldo" class="w-full bg-gray-100 border border-gray-200 text-gray-900 text-sm rounded-xl p-3 pl-10 cursor-not-allowed font-bold" value="0" disabled>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Pilih Rekening Tujuan</label>
                            <select name="rekening_bank_id" id="rekening_bank_id" class="select2-modal" required>
                                <option value="">Pilih Rekening...</option>
                                @foreach($bank_accounts as $bank)
                                    <option value="{{ $bank->id }}">{{ $bank->bank_name }} - {{ $bank->account_number }} ({{ $bank->account_name }})</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Jumlah Penarikan (Rp)</label>
                            <input type="number" name="jumlah" id="jumlah" min="10000" class="w-full bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-xl focus:ring-blue-500 focus:border-blue-500 p-3 dark:bg-gray-700 dark:border-gray-600 dark:text-white" placeholder="Min. 10.000" required>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Biaya Penarikan</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500 font-bold text-sm">Rp</span>
                                <input type="text" class="w-full bg-gray-100 border border-gray-200 text-gray-900 text-sm rounded-xl p-3 pl-10 cursor-not-allowed font-bold" value="6.500,00" disabled>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Total Diterima</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-emerald-600 font-bold text-sm">Rp</span>
                                <input type="text" id="display_total_terima" class="w-full bg-gray-100 border border-gray-200 text-emerald-600 text-sm rounded-xl p-3 pl-10 cursor-not-allowed font-bold" value="0,00" disabled>
                            </div>
                        </div>
                    </div>

                    <div class="px-6 py-4 bg-gray-50 dark:bg-gray-900/50 flex justify-end gap-3 mt-4">
                        <button type="button" class="close-modal px-4 py-2 text-sm font-bold text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-xl transition-colors">Batal</button>
                        <button type="submit" class="px-6 py-2 bg-blue-600 text-white text-sm font-bold rounded-xl shadow-lg hover:bg-blue-700 active:scale-95 transition-all">Ajukan Penarikan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            const table = $('#penarikan-table').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: '{{ route('penarikan.data') }}',
                columns: [
                    { data: 'created_at', name: 'created_at', render: function(data) {
                        return `<span class="text-gray-700 dark:text-gray-300 font-medium">${data}</span>`;
                    }},
                    { data: 'status', name: 'status' },
                    { data: 'jumlah', name: 'jumlah', render: function(data) {
                        return `<span class="font-bold text-gray-900 dark:text-white">${data}</span>`;
                    }},
                    { data: 'fee', name: 'fee', render: function(data) {
                        return `<span class="text-rose-600 dark:text-rose-400 font-medium">${data}</span>`;
                    }},
                    { data: 'total_terima', name: 'total_terima', render: function(data) {
                        return `<span class="font-bold text-emerald-600 dark:text-emerald-400">${data}</span>`;
                    }},
                    { data: 'penerima', name: 'penerima', render: function(data) {
                        return `<span class="font-bold text-gray-700 dark:text-gray-300">${data}</span>`;
                    }}
                ],
                order: [[0, 'desc']]
            });

            // Modal Logic
            $('#btn-request-penarikan').on('click', function() {
                $('#modal-request').removeClass('hidden');
                // Re-init select2 when modal opens
                $('.select2-modal').select2({
                    theme: 'bootstrap-5',
                    width: '100%',
                    dropdownParent: $('#modal-request')
                });
            });

            $('#project_id').on('change', function() {
                const selected = $(this).find('option:selected');
                const saldo = selected.data('saldo');
                
                if (saldo !== undefined) {
                    const formatted = new Intl.NumberFormat('id-ID', {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    }).format(saldo);
                    $('#display_saldo').val(formatted);
                } else {
                    $('#display_saldo').val('0');
                }
            });

            $('.close-modal, #close-modal-bg').on('click', function() {
                $('#modal-request').addClass('hidden');
            });

            $('#jumlah').on('input', function() {
                const jumlah = parseFloat($(this).val()) || 0;
                const fee = 6500;
                let totalTerima = jumlah - fee;
                if (totalTerima < 0) totalTerima = 0;
                
                const formatted = new Intl.NumberFormat('id-ID', {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                }).format(totalTerima);
                $('#display_total_terima').val(formatted);
            });

            // Form Submission
            $('#form-penarikan').on('submit', function(e) {
                e.preventDefault();
                const btn = $(this).find('button[type="submit"]');
                const originalText = btn.text();
                
                btn.prop('disabled', true).text('Memproses...');

                $.ajax({
                    url: '{{ route('penarikan.store') }}',
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: response.message,
                                customClass: {
                                    confirmButton: 'px-6 py-2 bg-emerald-500 text-white rounded-xl font-bold'
                                },
                                buttonsStyling: false
                            });
                            $('#modal-request').addClass('hidden');
                            $('#form-penarikan')[0].reset();
                            $('#display_total_terima').val('0,00');
                            $('.select2-modal').val(null).trigger('change');
                            location.reload();
                        } else {
                            Swal.fire('Gagal!', response.message, 'error');
                        }
                    },
                    error: function(xhr) {
                        const message = xhr.responseJSON ? xhr.responseJSON.message : 'Terjadi kesalahan sistem.';
                        Swal.fire({
                            icon: 'error',
                            title: 'Opps...',
                            text: message,
                            customClass: {
                                confirmButton: 'px-6 py-2 bg-rose-500 text-white rounded-xl font-bold'
                            },
                            buttonsStyling: false
                        });
                    },
                    complete: function() {
                        btn.prop('disabled', false).text(originalText);
                    }
                });
            });
        });
    </script>

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

        /* Select2 Tailwind styling */
        .select2-container .select2-selection--single {
            @apply h-[46px] bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-xl focus:ring-blue-500 focus:border-blue-500 px-3 py-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white shadow-sm transition-all !important;
        }
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            @apply text-gray-900 dark:text-white leading-[26px] p-0 !important;
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            @apply h-[44px] flex items-center justify-center mr-2 !important;
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow b {
            @apply border-gray-500 dark:border-gray-400 !important;
        }
        .select2-dropdown {
            @apply bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl shadow-lg mt-1 overflow-hidden z-[9999] !important;
        }
        .select2-results__option {
            @apply px-4 py-2 text-sm text-gray-700 dark:text-gray-300 transition-colors duration-150 !important;
        }
        .select2-container--default .select2-results__option--highlighted.select2-results__option--selectable {
            @apply bg-blue-600 text-white !important;
        }
        .select2-container--default .select2-results__option[aria-selected=true] {
            @apply bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-white !important;
        }
        .select2-search--dropdown .select2-search__field {
            @apply bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-gray-900 dark:text-white text-sm px-3 py-2 w-full outline-none !important;
        }
        .select2-container--default .select2-search--dropdown {
            @apply p-2 !important;
        }
    </style>
</x-app-layout>
