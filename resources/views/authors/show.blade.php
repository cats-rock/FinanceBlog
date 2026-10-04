<x-site-layout>
    <x-site-page-header :title="$author->name">
        {{-- articles_count contains only public Articles because the controller filters it. --}}
        <p class="mt-4 font-label text-label-s text-ink-muted">
            {{ $author->articles_count }} {{ Str::plural('article', $author->articles_count) }}
        </p>
    </x-site-page-header>

    {{-- Display only the public Articles prepared by AuthorController::show(). --}}
    <ul class="mt-10 grid grid-cols-1 gap-x-8 gap-y-12 sm:grid-cols-2 md:mt-[3.75rem] lg:grid-cols-3">
        @forelse ($articles as $article)
            <x-site-article-card :article="$article" />
        @empty
            <li class="text-body-s text-ink-muted">This Author has no public Articles.</li>
        @endforelse
    </ul>
</x-site-layout>
