<div>
{{-- This menu link returns from one article to the complete public article list. --}}
Header comes here | <a href="/articles">Articles</a>
</div>

{{-- $article is the single Article passed to this view by ArticleController::show(). --}}

<h1>{{ $article->title }}</h1>

<p>{{ $article->content }}</p>

{{-- The author's name will be added later after creating the User relationship. --}}

<div>
    Footer comes here
</div>
