<div>
    Header comes here
</div>

<h1>Articles overview</h1>

<p>These are the public articles from our Finance Blog.</p>

<ul>
    {{-- Loop through the $articles collection received from ArticleController. --}}
    @forelse ($articles as $article)
        <li>
            {{-- $article represents one database row; title and content are its column values. --}}
            <strong>{{ $article->title }}</strong>

            <p>{{ $article->content }}</p>
        </li>
    @empty
        {{-- This branch is displayed when the controller returns an empty collection. --}}
        <li>No public articles are available.</li>
    @endforelse
</ul>

<div>
    Footer comes here
</div>
