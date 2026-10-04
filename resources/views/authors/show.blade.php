{{-- Display one User in their public role as an Article author. --}}
<x-site-layout>

    <h1 class="text-2xl font-bold">{{ $author->name }}</h1>

    {{-- articles_count contains only public Articles because the controller filters the count. --}}
    <p class="mt-1 mb-6 italic">
        {{ $author->articles_count }} {{ Str::plural('article', $author->articles_count) }}
    </p>

    {{-- Display only the public Articles prepared by AuthorController::show(). --}}
    <ul class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse ($articles as $article)
            <li class="p-1 border-t border-black hover:bg-gray-200">
                {{-- Link each related Tag to its own public Tag page. --}}
                @foreach ($article->tags as $tag)
                    <a
                        class="bg-black text-green-200 text-xs rounded-full px-2"
                        href="{{ route('tags.show', $tag) }}"
                    >
                        {{ $tag->name }}
                    </a>
                @endforeach

                {{-- Open the complete public Article through its named route. --}}
                <a class="block text-xl font-semibold" href="{{ route('articles.show', $article) }}">
                    {{ $article->title }}
                </a>

                {{-- Show the creation date when the Article has timestamp data. --}}
                <span class="italic text-sm">
                    {{ $article->created_at?->toFormattedDateString() }}
                </span>

                {{-- Provide a short linked preview instead of repeating the complete Article. --}}
                <a class="block mt-4 text-gray-700" href="{{ route('articles.show', $article) }}">
                    {{ Str::limit($article->content, 100) }}
                </a>
            </li>
        @empty
            <li class="lg:col-span-3">This author has no public Articles.</li>
        @endforelse
    </ul>

</x-site-layout>
