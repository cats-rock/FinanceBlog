<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    {{-- Use the same readable body font and code-like labels as the public FinanceBlog pages. --}}
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=ibm-plex-mono:400,500|manrope:400,500,600&display=swap" rel="stylesheet">

    {{-- Vite builds FinanceBlog's Tailwind theme and starts Alpine from resources/js/app.js. --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-paper font-sans text-ink antialiased">
<div class="min-h-screen bg-paper-sunk">
    @include('layouts.app_navigation')

    <!-- Page Heading -->
    @isset($header)
        <header class="border-b border-rule bg-paper shadow-sm">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
    @endisset

    <!-- Page Content -->
    <main>
        {{ $slot }}
    </main>
</div>
</body>
</html>
