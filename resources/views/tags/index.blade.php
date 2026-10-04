{{-- List every Tag together with the number of public Articles using it. --}}
<x-site-layout>

    <h1 class="text-2xl font-bold">Tags overview</h1>
    <p>All Tags available for organizing FinanceBlog Articles.</p>

    {{-- TagController supplies every Tag but counts only related public Articles. --}}
    <ul class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 mt-8 gap-8">
        @forelse ($tags as $tag)
            <li class="p-1 border-t border-black hover:bg-gray-200">
                {{-- Open the selected Tag's public detail page through its named route. --}}
                <a class="block text-xl font-semibold" href="{{ route('tags.show', $tag) }}">
                    {{ $tag->name }}
                </a>

                {{-- Str::plural chooses "article" or "articles" from the public-only count. --}}
                <span class="italic text-sm">
                    {{ $tag->articles_count }} {{ Str::plural('article', $tag->articles_count) }}
                </span>
            </li>
        @empty
            <li class="lg:col-span-3">No Tags are available.</li>
        @endforelse
    </ul>

</x-site-layout>
