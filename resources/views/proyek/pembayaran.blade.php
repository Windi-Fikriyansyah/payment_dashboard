<x-app-layout>
    <x-slot name="header">
        Metode Pembayaran: {{ $project->nama }}
    </x-slot>

    <div class="space-y-8 animate-in fade-in slide-in-from-bottom-4 duration-700">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-extrabold text-gray-900 dark:text-white">Metode Pembayaran</h1>
                <p class="text-gray-500 mt-1">Kelola metode pembayaran yang tersedia untuk proyek ini.</p>
            </div>
            <a href="{{ route('proyek.index', $project->encrypted_id) }}" class="px-5 py-2.5 bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300 rounded-xl font-bold text-sm hover:bg-gray-200 dark:hover:bg-gray-700 transition">
                ← Kembali
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($payment_methods as $method)
                <div class="bg-white dark:bg-gray-800 p-6 rounded-3xl border border-gray-100 dark:border-gray-700 shadow-xl shadow-gray-200/10 dark:shadow-none transition-all hover:shadow-2xl hover:-translate-y-1 relative overflow-hidden group">
                    <div class="flex justify-between items-start mb-6">
                        <div class="w-16 h-16 bg-gray-50 dark:bg-gray-900 rounded-2xl p-2 flex items-center justify-center border border-gray-100 dark:border-gray-700 group-hover:scale-110 transition-transform">
                            @if($method->image_url)
                                <img src="{{ $method->image_url }}" alt="{{ $method->name }}" class="max-w-full max-h-full object-contain">
                            @else
                                <span class="text-xs font-bold text-gray-400">{{ $method->code }}</span>
                            @endif
                        </div>
                        
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" 
                                   class="sr-only peer toggle-payment" 
                                   data-id="{{ $method->id }}"
                                   {{ $method->is_enabled ? 'checked' : '' }}>
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                        </label>
                    </div>

                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-1">{{ $method->name }}</h3>
                    <p class="text-xs text-gray-500 font-mono mb-4">{{ $method->code }}</p>

                    <div class="space-y-2 mt-4 pt-4 border-t border-gray-50 dark:border-gray-700">
                        <div class="flex justify-between text-xs">
                            <span class="text-gray-500">Fee Percent:</span>
                            <span class="font-bold text-gray-900 dark:text-white">{{ $method->fee_percent }}%</span>
                        </div>
                        <div class="flex justify-between text-xs">
                            <span class="text-gray-500">Fee Flat:</span>
                            <span class="font-bold text-gray-900 dark:text-white">Rp {{ number_format($method->fee_flat, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <!-- Status Indicator (Bottom line) -->
                    <div class="absolute bottom-0 left-0 h-1 transition-all duration-300 status-bar {{ $method->is_enabled ? 'bg-blue-500 w-full' : 'bg-transparent w-0' }}"></div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Toast Notification -->
    <div id="toast" class="fixed bottom-10 right-10 z-[100] transform translate-y-24 opacity-0 transition-all duration-500">
        <div class="bg-gray-900 text-white px-6 py-3 rounded-2xl shadow-2xl flex items-center gap-3 border border-white/10 backdrop-blur-md">
            <div class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></div>
            <span id="toast-message" class="text-sm font-bold">Berhasil diperbarui!</span>
        </div>
    </div>

    @push('scripts')
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.toggle-payment').on('change', function() {
                const $cb = $(this);
                const methodId = $cb.data('id');
                const isChecked = $cb.is(':checked');
                const $card = $cb.closest('.group');
                const $statusBar = $card.find('.status-bar');

                // Visual feedback during request (optional)
                $card.addClass('opacity-70 contrast-75');

                $.ajax({
                    url: '{{ route("proyek.pembayaran.toggle", $project->encrypted_id) }}',
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    data: {
                        payment_method_id: methodId
                    },
                    success: function(response) {
                        $card.removeClass('opacity-70 contrast-75');
                        if (response.success) {
                            showToast(response.message);
                            if (response.is_enabled) {
                                // Sync visual state
                                $cb.prop('checked', true);
                                $statusBar.removeClass('bg-transparent w-0').addClass('bg-blue-500 w-full');
                            } else {
                                $cb.prop('checked', false);
                                $statusBar.removeClass('bg-blue-500 w-full').addClass('bg-transparent w-0');
                            }
                        } else {
                            // Logic error but success: false
                            alert(response.message || 'Gagal memperbarui status.');
                            $cb.prop('checked', !isChecked);
                        }
                    },
                    error: function(xhr) {
                        $card.removeClass('opacity-70 contrast-75');
                        console.error('AJAX Error:', xhr.responseText);
                        alert('Gagal memperbarui metode pembayaran. Silakan coba lagi.');
                        // Revert checkbox state
                        $cb.prop('checked', !isChecked);
                        
                        // Revert bar state
                        if (!isChecked) {
                            $statusBar.removeClass('bg-blue-500 w-full').addClass('bg-transparent w-0');
                        } else {
                            $statusBar.removeClass('bg-transparent w-0').addClass('bg-blue-500 w-full');
                        }
                    }
                });
            });

            function showToast(message) {
                const toast = $('#toast');
                $('#toast-message').text(message);
                toast.removeClass('translate-y-24 opacity-0').addClass('translate-y-0 opacity-100');
                
                setTimeout(() => {
                    toast.removeClass('translate-y-0 opacity-100').addClass('translate-y-24 opacity-0');
                }, 3000);
            }
        });
    </script>
    @endpush
</x-app-layout>
