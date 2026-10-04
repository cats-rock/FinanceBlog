<x-site-layout>
    <x-site-page-header
        title="Articles"
        lede="Clear financial articles written for FinanceBlog readers."
    />

    {{-- The grid grows from one to three columns as the available screen width increases. --}}
    <ul class="mt-10 grid grid-cols-1 gap-x-8 gap-y-12 sm:grid-cols-2 md:mt-[3.75rem] lg:grid-cols-3">
        @forelse ($articles as $article)
            {{-- The component keeps every Article preview consistent and avoids repeated markup. --}}
            <x-site-article-card :article="$article" />
        @empty
            <li class="text-body-s text-ink-muted">No public Articles are available.</li>
        @endforelse
    </ul>
</x-site-layout>
