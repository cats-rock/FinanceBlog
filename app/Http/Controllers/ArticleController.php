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
}
