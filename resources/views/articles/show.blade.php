<div>
    Header comes here
</div>

{{-- $article is the single Article passed to this view by ArticleController::show(). --}}

<h1>{{ $article->title }}</h1>

<p>{{ $article->content }}</p>

{{-- The author's name will be added later after creating the User relationship. --}}

<div>
    Footer comes here
</div>