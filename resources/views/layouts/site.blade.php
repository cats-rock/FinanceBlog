{{-- This shared layout was moved here from resources/views/components/site-layout.blade.php. --}}
<!DOCTYPE html>
<html lang="en">
    <head>
        {{-- This shared metadata is included on every page that uses <x-site-layout>. --}}
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        {{-- Load Tailwind so its utility classes can style every page using this layout. --}}
        <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

        <title>Site title</title>
        <meta name="description" content="">
        <meta name="keywords" content="">
    </head>
    <body>
        {{-- The header is centered and uses Flexbox to separate the logo, menu, and account link. --}}
        <div class="bg-slate-600 border-b border-slate-500 p-3 text-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center">
                <div class="text-lg font-bold">FinanceBlog</div>

                <div>
                    @foreach ($menu as $item)
                        <a href="{{ $item['link'] }}" style="padding-right: 8px;">
                            {{ $item['label'] }}
                        </a>
                    @endforeach
                </div>

                {{-- Show Article management to logged-in users and Login to guests. --}}
                <div>
                    @auth
                        <a href="{{ route('admin.articles.index') }}">Article management</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>
                    @endauth
                </div>
            </div>
        </div>

        {{-- Keep each page's slot aligned with the header and give short pages a minimum content height. --}}
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 min-h-96">
            <div class="pt-8">
                {{ $slot }}
            </div>
        </div>

        {{-- Shared footer with the blog identity and responsive navigation. --}}
        <footer class="mt-8 bg-slate-900 text-gray-300">
            <div class="max-w-7xl mx-auto px-4 py-8 sm:px-6 lg:px-8 sm:flex sm:items-center sm:justify-between">
                <div>
                    <p class="text-lg font-semibold text-white">FinanceBlog</p>
                    <p class="mt-1 text-sm text-gray-400">
                        Simple financial articles and useful information.
                    </p>
                </div>

                {{-- On small screens the links wrap; on wider screens they sit beside the blog identity. --}}
                <nav class="mt-4 flex flex-wrap gap-5 sm:mt-0" aria-label="Footer navigation">
                    @foreach ($menu as $item)
                        <a
                            href="{{ $item['link'] }}"
                            class="text-sm hover:text-white hover:underline"
                        >
                            {{ $item['label'] }}
                        </a>
                    @endforeach
                </nav>
            </div>
        </footer>

    </body>
</html>
