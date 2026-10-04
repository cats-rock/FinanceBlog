{{-- Wrap this page's unique content in the shared site layout. --}}
<x-site-layout>

    {{-- Tailwind makes this heading larger (text-2xl) and bold (font-bold). --}}
    <h1 class="text-2xl font-bold">Articles overview</h1>

    <p>These are the public articles from our Finance Blog.</p>

    {{-- Display Article previews in one column on small screens and up to three columns on large screens. --}}
    <ul class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 mt-8 gap-8">
        {{-- Loop through the public Articles received from ArticleController. --}}
        @forelse ($articles as $article)
            <li class="p-1 border-t border-black hover:bg-gray-200">
                {{-- Display every Tag connected to this Article through the article_tag pivot table. --}}
                @foreach ($article->tags as $tag)
                    <span class="bg-black text-green-200 text-xs rounded-full px-2">
                        {{ $tag->name }}
                    </span>
                @endforeach

                {{-- Both the title and content preview open the selected Article's detail page. --}}
                <a class="block text-xl font-semibold" href="/articles/{{ $article->id }}">
                    {{ $article->title }}
                </a>

                {{-- Display the related User's name, or "unknown" if the relationship is missing. --}}
                <span class="italic text-sm">by {{ $article->author?->name ?? 'unknown' }}</span>

                {{-- Str::limit shortens long seeded content to a 100-character preview. --}}
                <a class="block mt-4 text-gray-700" href="/articles/{{ $article->id }}">
                    {{ Str::limit($article->content, 100) }}
                </a>
            </li>
        @empty
            {{-- This branch is displayed when the controller returns an empty collection. --}}
            <li class="lg:col-span-3">No public articles are available.</li>
        @endforelse
    </ul>

</x-site-layout>
