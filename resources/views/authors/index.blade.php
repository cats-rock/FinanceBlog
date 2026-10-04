{{-- List the Users who qualify as authors by having at least one public Article. --}}
<x-site-layout>

    <h1 class="text-2xl font-bold">Authors overview</h1>
    <p>Everyone who has written a public Article on FinanceBlog.</p>

    {{-- The controller supplies only public authors and counts only their public Articles. --}}
    <ul class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 mt-8 gap-8">
        @forelse ($authors as $author)
            <li class="p-1 border-t border-black hover:bg-gray-200">
                {{-- Open the selected User's public Author page through its named route. --}}
                <a class="block text-xl font-semibold" href="{{ route('authors.show', $author) }}">
                    {{ $author->name }}
                </a>

                {{-- Str::plural chooses "article" or "articles" from the filtered count. --}}
                <span class="italic text-sm">
                    {{ $author->articles_count }} {{ Str::plural('article', $author->articles_count) }}
                </span>
            </li>
        @empty
            <li class="lg:col-span-3">No public authors are available.</li>
        @endforelse
    </ul>

</x-site-layout>
