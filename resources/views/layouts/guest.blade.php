<!DOCTYPE html>
<html  lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-gray-50 dark:bg-gray-900">

<x-section class="min-h-screen flex items-center justify-center py-20">
<x-container class="max-w-md">

    <!-- Logo -->
    <div class="text-center mb-8">
        <a href="/">
            <img 
                src="{{ asset('images/logo_img.png') }}" 
                alt="logo"
                class="w-20 h-20 mx-auto text-gray-400">
        </a>

        <h1 class="mt-4 text-2xl font-bold text-gray-900 dark:text-white">
            {{ config('app.name') }}
        </h1>

        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
            Secure file sharing made simple
        </p>
    </div>

    <!-- Card -->
    <x-card class="p-8 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 bg-white dark:bg-gray-800">
        {{ $slot }}
    </x-card>

</x-container>
</x-section>

</body>
</html>