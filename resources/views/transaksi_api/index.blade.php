<x-app-layout>
    <x-slot name="header">
        Transaksi API
    </x-slot>

    <div class="space-y-6">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Daftar Transaksi API</h1>
            
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

    

    <script>
        $(document).ready(function() {
            // Modal visibility
            $('#open-create-modal').on('click', function() {
                $('#create-transaction-modal').removeClass('hidden');
            });

            $('#close-modal, #modal-overlay').on('click', function() {
                $('#create-transaction-modal').addClass('hidden');
            });

            

            var table = $('#transactions-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('transaksi_api.data') }}',
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
