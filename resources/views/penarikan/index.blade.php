<x-app-layout>
    <x-slot name="header">
        Penarikan
    </x-slot>

    <div class="space-y-6">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Riwayat Penarikan</h1>
            <button onclick="alert('Fitur request penarikan menyusul')"
                class="flex items-center gap-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-xl shadow-md transition-all duration-200 active:scale-95">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Request Penarikan
            </button>
        </div>

        <!-- DataTable Container -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden text-sm">
            <div class="p-6">
                <table id="penarikan-table" class="display w-full text-left text-gray-500 dark:text-gray-400">
                    <thead class="bg-gray-50 dark:bg-gray-900/50 text-gray-700 dark:text-gray-300 uppercase text-xs">
                        <tr>
                            <th class="px-6 py-4 font-bold">Tanggal</th>
                            <th class="px-6 py-4 font-bold">Status</th>
                            <th class="px-6 py-4 font-bold">Jumlah</th>
                            <th class="px-6 py-4 font-bold">Fee</th>
                            <th class="px-6 py-4 font-bold">Penerima</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#penarikan-table').DataTable({
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
                    { data: 'penerima', name: 'penerima', render: function(data) {
                        return `<span class="font-bold text-gray-700 dark:text-gray-300">${data}</span>`;
                    }}
                ],
                order: [[0, 'desc']]
            });
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
    </style>
</x-app-layout>
