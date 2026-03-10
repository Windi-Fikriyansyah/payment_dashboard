@props(['active', 'href'])

@php
$classes = ($active ?? false)
            ? 'flex items-center gap-3 px-3 py-2 text-sm font-semibold text-blue-600 bg-blue-50 dark:bg-blue-900/20 rounded-lg transition-colors group'
            : 'flex items-center gap-3 px-3 py-2 text-sm font-medium text-gray-600 dark:text-gray-400 hover:text-blue-600 hover:bg-gray-50 dark:hover:bg-gray-700/50 rounded-lg transition-colors group';
@endphp

<a {{ $attributes->merge(['class' => $classes, 'href' => $href]) }}>
    {{ $slot }}
</a>
