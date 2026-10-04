<x-site-layout>
    <x-site-page-header
        title="Author"
        lede="Meet the person behind FinanceBlog's public Articles."
    />

    {{-- The controller supplies only Users who have at least one public Article. --}}
    <ul class="mt-10 grid grid-cols-1 gap-x-8 gap-y-12 sm:grid-cols-2 md:mt-[3.75rem] lg:grid-cols-3">
        @forelse ($authors as $author)
            {{-- This shared card displays the User name and public Article count. --}}
            <x-site-list-card
                :title="$author->name"
                :href="route('authors.show', $author)"
                :count="$author->articles_count"
            />
        @empty
            <li class="text-body-s text-ink-muted">No public Authors are available.</li>
        @endforelse
    </ul>
</x-site-layout>
