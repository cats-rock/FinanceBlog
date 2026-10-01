{{-- Wrap this page's unique content in the shared site layout. --}}
<x-site-layout>

    {{-- $article is the single Article passed to this view by ArticleController::show(). --}}

    <h1>{{ $article->title }}</h1>

    {{-- Follow the Article author relationship and display the related User's name. --}}
    <p><i>Author: {{ $article->author->name }}</i></p>

    {{-- Follow the many-to-many relationship and display commas only between Tags. --}}
    <p>
        <i>Tags:</i>
        @foreach ($article->tags as $tag)
            {{ $tag->name }}{{ $loop->last ? '' : ', ' }}
        @endforeach
    </p>
    <hr>

    {{-- Display the content stored in this article's content column. --}}
    <p>{{ $article->content }}</p>

</x-site-layout>
