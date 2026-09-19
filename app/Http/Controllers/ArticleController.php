<?php

namespace App\Http\Controllers;

// Import the Article model so this controller can query the articles table.
use App\Models\Article;

class ArticleController extends Controller
{
    // The articles route calls index() when a visitor opens /articles.
    public function index()
    {
        // Retrieve only public articles and store the resulting collection in $articles.
        $articles = Article::where('is_public', true)->get();

        // Load articles/index.blade.php and make $articles available inside that view.
        return view('articles.index', compact('articles'));
    }
     // Laravel automatically finds the Article that matches {article} in the URL.
    public function show(Article $article)
    {
        // Hide private articles from visitors, even when they enter the URL directly, for articles that are not public.
        abort_unless($article->is_public, 404);

        // Load articles/show.blade.php and make the single $article available there.
        return view('articles.show', compact('article'));

        
    }
}
