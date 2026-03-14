<x-app-layout>
    <x-slot name="header">
        Rekening Bank ({{ $count }}/5)
    </x-slot>

    <div class="space-y-6">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Daftar Rekening Bank</h1>
            @if($count < 5)
            <button id="open-add-modal"
                class="flex items-center gap-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-xl shadow-md transition-all duration-200 active:scale-95">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Tambah Rekening
            </button>
            @endif
        </div>

        <!-- DataTable Container -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden text-sm">
            <div class="p-6">
                <table id="rekening-table" class="display w-full text-left text-gray-500 dark:text-gray-400">
                    <thead class="bg-gray-50 dark:bg-gray-900/50 text-gray-700 dark:text-gray-300 uppercase text-xs">
                        <tr>
                            <th class="px-6 py-4 font-bold">Bank/E-Wallet</th>
                            <th class="px-6 py-4 font-bold">Nomor Rekening</th>
                            <th class="px-6 py-4 font-bold">Atas Nama</th>
                            <th class="px-6 py-4 font-bold">Status</th>
                            <th class="px-6 py-4 font-bold">Tanggal Dibuat</th>
                            <th class="px-6 py-4 font-bold text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Rekening -->
    <div id="add-modal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500/75 backdrop-blur-sm transition-opacity" aria-hidden="true" id="modal-overlay"></div>

            <div class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full border border-gray-100 dark:border-gray-700">
                <form action="{{ route('rekening.store') }}" method="POST">
                    @csrf
                    <div class="bg-white dark:bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <h3 class="text-xl leading-6 font-bold text-gray-900 dark:text-white mb-6">
                            Tambah Rekening Baru
                        </h3>
                        <div class="space-y-5">
                            <div>
                                <label for="bank_code" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Pilih Bank/E-wallet</label>
                                <select name="bank_code" id="bank_code" required
                                    class="w-full bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-xl focus:ring-blue-500 focus:border-blue-500 p-3 dark:bg-gray-700 dark:border-gray-600 dark:text-white shadow-sm outline-none transition-all">
                                    <option></option>
                                    @foreach($banks as $bank)
                                        <option value="{{ $bank['bankCode'] }}">{{ $bank['bankName'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="account_number" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Nomor Rekening/E-Wallet</label>
                                <input type="text" name="account_number" id="account_number" required
                                    class="w-full bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-xl focus:ring-blue-500 focus:border-blue-500 p-3 dark:bg-gray-700 dark:border-gray-600 dark:text-white shadow-sm outline-none transition-all"
                                    placeholder="Masukkan nomor rekening">
                            </div>
                            <div>
                                <label for="account_name" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Atas Nama</label>
                                <input type="text" name="account_name" id="account_name" required
                                    class="w-full bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-xl focus:ring-blue-500 focus:border-blue-500 p-3 dark:bg-gray-700 dark:border-gray-600 dark:text-white shadow-sm outline-none transition-all"
                                    placeholder="Masukkan nama pemilik rekening">
                            </div>

                            <p class="text-xs text-red-500 italic mt-2">
                                Pastikan data rekening bank/e-wallet yang Anda masukkan sudah benar. Admin tidak bertanggung jawab atas kesalahan data yang dimasukkan.
                            </p>
                        </div>
                    </div>
                    <div class="bg-gray-50 dark:bg-gray-900/50 px-6 py-4 sm:flex sm:flex-row-reverse gap-3">
                        <button type="submit" class="w-full inline-flex justify-center items-center rounded-xl border border-transparent shadow-lg px-6 py-2.5 bg-blue-600 text-sm font-bold text-white hover:bg-blue-700 sm:w-auto transition-all duration-200 active:scale-95">
                            Simpan Rekening
                        </button>
                        <button type="button" id="close-modal" class="mt-3 w-full inline-flex justify-center items-center rounded-xl border border-gray-300 dark:border-gray-600 shadow-sm px-6 py-2.5 bg-white dark:bg-gray-800 text-sm font-bold text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 sm:mt-0 sm:w-auto">
                            Batal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            var table = $('#rekening-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('rekening.data') }}',
                columns: [
                    { data: 'bank_name', name: 'bank_name', render: function(data) {
                        return `<span class="font-bold text-gray-900 dark:text-white">${data}</span>`;
                    }},
                    { data: 'account_number', name: 'account_number', render: function(data) {
                        return `<span class="font-mono text-gray-600 dark:text-gray-400 font-bold">${data}</span>`;
                    }},
                    { data: 'account_name', name: 'account_name', render: function(data) {
                        return `<span class="text-gray-700 dark:text-gray-300 font-medium">${data}</span>`;
                    }},
                    { data: 'status', name: 'status', render: function(data) {
                        return `<span class="px-2 py-0.5 bg-emerald-100 text-emerald-600 rounded text-[10px] font-bold uppercase">${data}</span>`;
                    }},
                    { data: 'created_at', name: 'created_at' },
                    { data: 'aksi', name: 'aksi', orderable: false, searchable: false, className: 'text-center' }
                ],
                order: [[4, 'desc']]
            });

            // Initialize Select2
            $('#bank_code').select2({
                theme: 'bootstrap-5', // Bootstrap 5 theme matches modern layouts well
                dropdownParent: $('#add-modal'),
                placeholder: "Pilih Bank/E-wallet...",
                allowClear: true,
                width: '100%'
            });

            $('#open-add-modal').on('click', function() {
                $('#add-modal').removeClass('hidden');
            });

            $('#close-modal, #modal-overlay').on('click', function() {
                $('#add-modal').addClass('hidden');
            });

            window.confirmDelete = function(id) {
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Rekening akan dihapus permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '/rekening-bank/' + id,
                            type: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                if(response.success) {
                                    table.ajax.reload();
                                    Swal.fire('Terhapus!', 'Rekening berhasil dihapus.', 'success');
                                    location.reload(); // To update the counter in header
                                }
                            }
                        });
                    }
                })
            }
        });
    </script>

    <style>
        .dataTables_wrapper .dataTables_length select,
        .dataTables_wrapper .dataTables_filter input {
            @apply bg-white border border-gray-200 text-gray-900 text-sm rounded-xl focus:ring-blue-500 focus:border-blue-500 p-2 dark:bg-gray-800 dark:border-gray-700 dark:placeholder-gray-400 dark:text-white shadow-sm transition-all;
            outline: none;
        }
        .dataTables_wrapper .dataTables_length,
        .dataTables_wrapper .dataTables_filter {
            @apply mb-6 text-sm text-gray-600 dark:text-gray-400;
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
