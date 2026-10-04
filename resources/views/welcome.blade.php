<x-site-layout>
    {{-- The homepage introduces the blog and provides clear links to its main sections. --}}
    <x-site-page-header
        title="Understand money, one article at a time."
        lede="Explore clear FinanceBlog articles, meet the author, and find topics through Tags."
    />

    <div class="mt-10 flex flex-wrap gap-4">
        <x-site-button :href="route('articles.index')">Browse Articles</x-site-button>
        <x-site-button :href="route('authors.index')" variant="outline">Meet the Author</x-site-button>
        <x-site-button :href="route('tags.index')" variant="outline">Explore Tags</x-site-button>
    </div>
</x-site-layout>
