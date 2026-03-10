<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="h-full font-sans text-gray-900 antialiased">
        <div class="min-h-screen relative flex flex-col justify-center py-12 px-6 lg:px-8 bg-gray-50 dark:bg-gray-900">
            <!-- Background Decorations -->
            <div class="absolute inset-0 overflow-hidden pointer-events-none">
                <div class="absolute -top-[10%] -left-[10%] w-[40%] h-[40%] bg-blue-100 dark:bg-blue-900/10 rounded-full blur-3xl opacity-50"></div>
                <div class="absolute -bottom-[10%] -right-[10%] w-[40%] h-[40%] bg-indigo-100 dark:bg-indigo-900/10 rounded-full blur-3xl opacity-50"></div>
            </div>

            

            <div class="relative z-10">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>

