<x-app-layout>
    <x-slot name="header">
        Transaksi
    </x-slot>

    <div class="space-y-6">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Daftar Transaksi</h1>
            <button id="open-create-modal"
                class="flex items-center gap-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-xl shadow-md transition-all duration-200 active:scale-95">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Buat Transaksi
            </button>
        </div>

        <div id="custom-filters" class="hidden items-center gap-3">
            <select id="filter-project"
                class="bg-white border border-gray-200 text-gray-900 text-sm rounded-xl focus:ring-blue-500 focus:border-blue-500 p-2.5 pr-10 dark:bg-gray-800 dark:border-gray-700 dark:text-white shadow-sm outline-none cursor-pointer">
                <option value="">Semua Proyek</option>
                @foreach ($projects as $project)
                    <option value="{{ $project->id }}">{{ $project->nama }}</option>
                @endforeach
            </select>

            <select id="filter-mode"
                class="bg-white border border-gray-200 text-gray-900 text-sm rounded-xl focus:ring-blue-500 focus:border-blue-500 p-2.5 pr-10 dark:bg-gray-800 dark:border-gray-700 dark:text-white shadow-sm outline-none cursor-pointer">
                <option value="">Semua Mode</option>
                <option value="sandbox">Sandbox</option>
                <option value="production">Production</option>
            </select>

            <select id="filter-status"
                class="bg-white border border-gray-200 text-gray-900 text-sm rounded-xl focus:ring-blue-500 focus:border-blue-500 p-2.5 pr-10 dark:bg-gray-800 dark:border-gray-700 dark:text-white shadow-sm outline-none cursor-pointer">
                <option value="">Semua Status</option>
                <option value="success">Success</option>
                <option value="pending">Pending</option>
                <option value="failed">Failed</option>
                <option value="expired">Expired</option>
            </select>
        </div>

        <!-- DataTable Container -->
        <div
            class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden text-sm">
            <div class="p-6">
                <table id="transactions-table" class="display w-full text-left text-gray-500 dark:text-gray-400">
                    <thead class="bg-gray-50 dark:bg-gray-900/50 text-gray-700 dark:text-gray-300 uppercase text-xs">
                        <tr>
                            <th class="px-6 py-4 font-bold">Tanggal</th>
                            <th class="px-6 py-4 font-bold">Order ID</th>
                            <th class="px-6 py-4 font-bold">Mode</th>
                            <th class="px-6 py-4 font-bold">Metode</th>
                            <th class="px-6 py-4 font-bold">Total Bayar</th>
                            <th class="px-6 py-4 font-bold">Status</th>
                            <th class="px-6 py-4 font-bold">Proyek</th>
                            <th class="px-6 py-4 font-bold">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Yajra Data -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- DataTables Script -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

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

        .dataTables_wrapper .dataTables_filter input {
            @apply ml-2;
        }

        .dataTables_wrapper .dataTables_length,
        .dataTables_wrapper .dataTables_filter {
            @apply mb-6 text-sm text-gray-600 dark:text-gray-400;
        }

        .dataTables_wrapper .dataTables_filter {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 1rem;
            float: right;
            margin-bottom: 1.5rem;
        }

        .dataTables_wrapper .dataTables_filter label {
            display: flex;
            align-items: center;
            margin-bottom: 0;
        }
    </style>

    <!-- Create Transaction Modal -->
    <div id="create-transaction-modal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title"
        role="dialog" aria-modal="true">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <!-- Background overlay -->
            <div class="fixed inset-0 bg-gray-500/75 backdrop-blur-sm transition-opacity" aria-hidden="true"
                id="modal-overlay"></div>

            <!-- Modal panel -->
            <div
                class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full border border-gray-100 dark:border-gray-700">
                <div class="bg-white dark:bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                            <h3 class="text-xl leading-6 font-bold text-gray-900 dark:text-white mb-6" id="modal-title">
                                Buat Transaksi Baru
                            </h3>
                            <div class="space-y-5">
                                <div>
                                    <label for="modal-project-id"
                                        class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Pilih
                                        Proyek</label>
                                    <select id="modal-project-id"
                                        class="w-full bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-xl focus:ring-blue-500 focus:border-blue-500 p-3 dark:bg-gray-700 dark:border-gray-600 dark:text-white shadow-sm outline-none transition-all">
                                        <option value="" disabled selected>Pilih Proyek...</option>
                                        @foreach ($projects as $project)
                                            <option value="{{ $project->id }}" data-slug="{{ $project->slug }}">
                                                {{ $project->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label for="modal-amount"
                                        class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Jumlah
                                        Pembayaran</label>
                                    <div class="relative group">
                                        <div
                                            class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                            <span
                                                class="text-gray-500 font-bold text-sm group-focus-within:text-blue-500 transition-colors">Rp</span>
                                        </div>
                                        <input type="number" id="modal-amount"
                                            class="w-full pl-12 bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-xl focus:ring-blue-500 focus:border-blue-500 p-3 dark:bg-gray-700 dark:border-gray-600 dark:text-white shadow-sm outline-none transition-all"
                                            placeholder="Contoh: 15000">
                                    </div>
                                    <p class="mt-2 text-[11px] text-gray-500 dark:text-gray-400 italic">* Masukkan
                                        nominal tanpa titik atau koma</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 dark:bg-gray-900/50 px-6 py-4 sm:flex sm:flex-row-reverse gap-3 mt-4">
                    <button type="button" id="submit-create-transaction"
                        class="w-full inline-flex justify-center items-center rounded-xl border border-transparent shadow-lg px-6 py-2.5 bg-blue-600 text-sm font-bold text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:w-auto transition-all duration-200 active:scale-95">
                        Buat Transaksi
                    </button>
                    <button type="button" id="close-modal"
                        class="mt-3 w-full inline-flex justify-center items-center rounded-xl border border-gray-300 dark:border-gray-600 shadow-sm px-6 py-2.5 bg-white dark:bg-gray-800 text-sm font-bold text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:w-auto transition-all duration-200">
                        Batal
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Modal visibility
            $('#open-create-modal').on('click', function() {
                $('#create-transaction-modal').removeClass('hidden');
            });

            $('#close-modal, #modal-overlay').on('click', function() {
                $('#create-transaction-modal').addClass('hidden');
            });

            // Handle submission
            $('#submit-create-transaction').on('click', function() {
                const projectSelect = $('#modal-project-id');
                const selectedOption = projectSelect.find('option:selected');
                const slug = selectedOption.data('slug');
                const amount = $('#modal-amount').val();

                if (!slug || !amount) {
                    alert('Harap pilih proyek dan isi jumlah pembayaran');
                    return;
                }

                // Generate random order ID (Format: namaproyek_randomnumber)
                const projectName = selectedOption.text().trim().toLowerCase().replace(/\s+/g, '');
                const randomId = Math.floor(Math.random() * 100000);
                const orderId = `${projectName}_${randomId}`;

                // Redirect to the URL
                const url = `http://127.0.0.1:3005/pay/${slug}/${amount}?order_id=${orderId}`;
                window.open(url, '_blank');

                // Close modal and reset
                $('#create-transaction-modal').addClass('hidden');
                $('#modal-amount').val('');
                projectSelect.val('');
            });

            var table = $('#transactions-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('transaksi.data') }}',
                    data: function(d) {
                        d.status = $('#filter-status').val();
                        d.mode = $('#filter-mode').val();
                        d.project_id = $('#filter-project').val();
                    }
                },
                columns: [{
                        data: 'tanggal_format',
                        name: 'created_at',
                        render: function(data) {
                            return `<span class="text-gray-600 dark:text-gray-400 font-medium whitespace-nowrap">${data}</span>`;
                        }
                    },
                    {
                        data: 'order_id',
                        name: 'order_id',
                        render: function(data) {
                            return `<span class="font-bold font-mono text-gray-900 dark:text-white uppercase">${data}</span>`;
                        }
                    },
                    {
                        data: 'mode_badge',
                        name: 'mode'
                    },
                    {
                        data: 'payment_method',
                        name: 'payment_method',
                        render: function(data) {
                            return `<span class="px-2 py-1 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded text-[10px] font-bold uppercase">${data || 'N/A'}</span>`;
                        }
                    },
                    {
                        data: 'total_format',
                        name: 'total_payment',
                        render: function(data, type, row) {
                            return `<div class="flex flex-col">
                                        <span class="font-bold text-gray-900 dark:text-white">${data}</span>
                                        <span class="text-[10px] text-red-500 font-medium">(-${row.fee_format})</span>
                                    </div>`;
                        }
                    },
                    {
                        data: 'status_badge',
                        name: 'status'
                    },
                    {
                        data: 'nama_proyek',
                        name: 'projects.nama',
                        render: function(data) {
                            return `<span class="text-gray-700 dark:text-gray-300 font-semibold">${data}</span>`;
                        }
                    },
                    {
                        data: 'aksi',
                        name: 'aksi',
                        orderable: false,
                        searchable: false
                    }
                ],
                order: [
                    [0, 'desc']
                ], // Default order by created_at
                initComplete: function() {
                    $('#custom-filters').removeClass('hidden').addClass('flex').prependTo(
                        '.dataTables_filter');
                }
            });

            // Trigger reload when filters change
            $('#filter-status, #filter-mode, #filter-project').on('change', function() {
                table.ajax.reload();
            });
        });
    </script>
</x-app-layout>
