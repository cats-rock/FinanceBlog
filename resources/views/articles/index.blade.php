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
                {{-- Each Tag badge links to a page listing the public Articles connected to that Tag. --}}
                @foreach ($article->tags as $tag)
                    <a
                        class="bg-black text-green-200 text-xs rounded-full px-2"
                        href="{{ route('tags.show', $tag) }}"
                    >
                        {{ $tag->name }}
                    </a>
                @endforeach

                {{-- Named routes keep the view independent from the exact Article URL structure. --}}
                <a class="block text-xl font-semibold" href="{{ route('articles.show', $article) }}">
                    {{ $article->title }}
                </a>

                {{-- Link to the Author page only when the related User exists. --}}
                @if ($article->author)
                    <a class="italic text-sm" href="{{ route('authors.show', $article->author) }}">
                        by {{ $article->author->name }}
                    </a>
                @else
                    <span class="italic text-sm">by unknown</span>
                @endif

                {{-- Str::limit shortens long seeded content to a 100-character preview. --}}
                <a class="block mt-4 text-gray-700" href="{{ route('articles.show', $article) }}">
                    {{ Str::limit($article->content, 100) }}
                </a>
            </li>
        @empty
            {{-- This branch is displayed when the controller returns an empty collection. --}}
            <li class="lg:col-span-3">No public articles are available.</li>
        @endforelse
    </ul>

</x-site-layout>
