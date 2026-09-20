{{-- Wrap this page's unique content in the shared site layout. --}}
<x-site-layout>

    {{-- $article is the single Article passed to this view by ArticleController::show(). --}}

    <h1>{{ $article->title }}</h1>

    <p>{{ $article->content }}</p>

    {{-- The author's name will be added later after creating the User relationship. --}}

</x-site-layout>
