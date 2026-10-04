<x-site-layout>
    <x-site-page-header
        title="Tags"
        lede="Browse the topics used to organize FinanceBlog Articles."
    />

    {{-- TagController supplies every Tag and its public Article count. --}}
    <ul class="mt-10 grid grid-cols-1 gap-x-8 gap-y-12 sm:grid-cols-2 md:mt-[3.75rem] lg:grid-cols-3">
        @forelse ($tags as $tag)
            <x-site-list-card
                :title="$tag->name"
                :href="route('tags.show', $tag)"
                :count="$tag->articles_count"
            />
        @empty
            <li class="text-body-s text-ink-muted">No Tags are available.</li>
        @endforelse
    </ul>
</x-site-layout>
