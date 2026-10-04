{{-- Wrap this page's unique content in the shared site layout. --}}
<x-site-layout>

    {{-- $article is the single Article passed to this view by ArticleController::show(). --}}

    {{-- Display related Tags as badges that link to their public Tag pages. --}}
    <div class="flex flex-wrap gap-2 mb-3">
        @forelse ($article->tags as $tag)
            <a
                class="bg-black text-green-200 text-xs rounded-full px-2"
                href="{{ route('tags.show', $tag) }}"
            >
                {{ $tag->name }}
            </a>
        @empty
            <span class="text-sm text-gray-500">No tags</span>
        @endforelse
    </div>

    <h1 class="text-2xl font-bold">{{ $article->title }}</h1>

    {{-- Link the related User to their public Author page when the relationship exists. --}}
    <p class="mt-1 mb-6 italic">
        Author:
        @if ($article->author)
            <a class="underline hover:text-slate-600" href="{{ route('authors.show', $article->author) }}">
                {{ $article->author->name }}
            </a>
        @else
            unknown
        @endif
    </p>

    {{-- Preserve paragraph breaks in the longer factory-generated Article content. --}}
    <div>
        <p class="whitespace-pre-line leading-7">{{ $article->content }}</p>
    </div>

</x-site-layout>
