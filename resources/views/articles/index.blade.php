{{-- Wrap this page's unique content in the shared site layout. --}}
<x-site-layout>

{{-- Tailwind makes this heading larger (text-2xl) and bold (font-bold). --}}
<h1 class="text-2xl font-bold">Articles overview</h1>

<p>These are the public articles from our Finance Blog.</p>

{{-- Tailwind displays bullets and adds vertical space between article rows. --}}
<ul class="list-disc list-inside space-y-2">
    {{-- Loop through the $articles collection received from ArticleController. --}}
    @forelse ($articles as $article)
        <li>
            {{-- Insert this article's ID into the URL so clicking its title opens its show page. --}}
            {{-- Make the title visibly clickable and add space before the author text. --}}
            <a href="/articles/{{ $article->id }}" class="text-blue-600 underline hover:text-blue-800 mr-1">
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
