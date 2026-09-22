{{-- Wrap this page's unique content in the shared site layout. --}}
<x-site-layout>

{{-- Tailwind makes this heading larger (text-2xl) and bold (font-bold). --}}
<h1 class="text-2xl font-bold">Articles overview</h1>

<p>These are the public articles from our Finance Blog.</p>

{{-- Tailwind displays disc-shaped bullets and places them inside the list area. --}}
<ul class="list-disc list-inside">
    {{-- Loop through the $articles collection received from ArticleController. --}}
    @forelse ($articles as $article)
        <li>
            {{-- Insert this article's ID into the URL so clicking its title opens its show page. --}}
            <a href="/articles/{{ $article->id }}">
                {{ $article->title }}
            </a>
            {{-- Follow the Article author relationship and display the related User's name. --}}
            by {{ $article->author->name }}
        </li>
    @empty
        {{-- This branch is displayed when the controller returns an empty collection. --}}
        <li>No public articles are available.</li>
    @endforelse
</ul>

</x-site-layout>
