{{-- Wrap this page's unique content in the shared site layout. --}}
<x-site-layout>

    {{-- $article is the single Article passed to this view by ArticleController::show(). --}}

    {{-- Display related Tags as separate badges, so comma separators are no longer needed. --}}
    <div class="flex flex-wrap gap-2 mb-3">
        @forelse ($article->tags as $tag)
            <span class="bg-black text-green-200 text-xs rounded-full px-2">
                {{ $tag->name }}
            </span>
        @empty
            <span class="text-sm text-gray-500">No tags</span>
        @endforelse
    </div>

    <h1 class="text-2xl font-bold">{{ $article->title }}</h1>

    {{-- Follow the Article author relationship and display the related User's name. --}}
    <p class="mt-1 mb-6 italic">Author: {{ $article->author?->name ?? 'unknown' }}</p>

    {{-- Preserve paragraph breaks in the longer factory-generated Article content. --}}
    <div>
        <p class="whitespace-pre-line leading-7">{{ $article->content }}</p>
    </div>

</x-site-layout>
