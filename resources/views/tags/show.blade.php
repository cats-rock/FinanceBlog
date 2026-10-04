<x-site-layout>
    <x-site-page-header :title="$tag->name">
        {{-- articles_count contains only public Articles because TagController filters it. --}}
        <p class="mt-4 font-label text-label-s text-ink-muted">
            {{ $tag->articles_count }} {{ Str::plural('article', $tag->articles_count) }}
        </p>
    </x-site-page-header>

    {{-- Display only the public Articles prepared by TagController::show(). --}}
    <ul class="mt-10 grid grid-cols-1 gap-x-8 gap-y-12 sm:grid-cols-2 md:mt-[3.75rem] lg:grid-cols-3">
        @forelse ($articles as $article)
            <x-site-article-card :article="$article" />
        @empty
            <li class="text-body-s text-ink-muted">No public Articles use this Tag yet.</li>
        @endforelse
    </ul>
</x-site-layout>
