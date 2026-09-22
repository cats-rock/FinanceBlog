<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::all();

        return view('admin.articles.index', compact('articles'));
    }

    // Display the form used to enter a new article's data.
    public function create()
    {
        return view('admin.articles.create');
    }

    // Receive the submitted form data and store a new article.
    public function store(Request $request)
    {
        // Validation rules will be added in a later step.

        // is_public is omitted, so the database default creates a private article.
        Article::create([
            'title' => $request['title'],
            'content' => $request['content'],
            'author_id' => $request['author_id'],
        ]);

        // Return the administrator to the complete article list after creation.
        return redirect()->route('admin.articles.index');
    }
}
