<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="icon" href="/favicon.ico" sizes="any" />

        <title>{{ filled($title ?? null) ? $title.' - FinanceBlog' : 'FinanceBlog' }}</title>
        <meta name="description" content="{{ $description ?? 'Clear financial articles and practical information.' }}" />

        {{-- These fonts support the clean body text and code-like labels in the design. --}}
        <link rel="preconnect" href="https://fonts.bunny.net" />
        <link href="https://fonts.bunny.net/css?family=ibm-plex-mono:400,500|manrope:400,500,600" rel="stylesheet" />

        {{-- Vite builds the local Tailwind styles and responsive navigation script. --}}
        @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/site-nav.js'])
    </head>
    <body class="bg-[#edf2f7] font-sans text-ink antialiased">
        <div class="flex min-h-screen flex-col">
            {{-- The same responsive header is shared by every public page. --}}
            <x-site-header :menu="$menu" />

            <main class="flex-1">
                <div class="mx-auto max-w-[87.5rem] px-5 py-10 md:px-10 md:py-[3.75rem] lg:py-20">
                    {{ $slot }}
                </div>
            </main>

            {{-- Every public page shares the same simple FinanceBlog footer. --}}
            <x-site-footer />
        </div>
    </body>
</html>
