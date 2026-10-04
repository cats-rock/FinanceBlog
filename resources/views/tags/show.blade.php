{{-- Display one Tag and the public Articles connected to it. --}}
<x-site-layout>

    <h1 class="text-2xl font-bold">{{ $tag->name }}</h1>

    {{-- articles_count contains only public Articles because TagController filters the count. --}}
    <p class="mt-1 mb-6 italic">
        {{ $tag->articles_count }} {{ Str::plural('article', $tag->articles_count) }}
    </p>

    {{-- Display only the public Articles prepared by TagController::show(). --}}
    <ul class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse ($articles as $article)
            <li class="p-1 border-t border-black hover:bg-gray-200">
                {{-- Open the complete public Article through its named route. --}}
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

                {{-- Provide a short linked preview instead of repeating the complete Article. --}}
                <a class="block mt-4 text-gray-700" href="{{ route('articles.show', $article) }}">
                    {{ Str::limit($article->content, 100) }}
                </a>
            </li>
        @empty
            <li class="lg:col-span-3">No public Articles use this Tag yet.</li>
        @endforelse
    </ul>

</x-site-layout>
