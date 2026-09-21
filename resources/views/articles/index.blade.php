{{-- Wrap this page's unique content in the shared site layout. --}}
<x-site-layout>

<h1>Articles overview</h1>

<p>These are the public articles from our Finance Blog.</p>

<ul>
    {{-- Loop through the $articles collection received from ArticleController. --}}
    @forelse ($articles as $article)
        <li>
            {{-- Insert this article's ID into the URL so clicking its title opens its show page. --}}
            <a href="/articles/{{ $article->id }}">
                <b>{{ $article->title }}</b>
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
