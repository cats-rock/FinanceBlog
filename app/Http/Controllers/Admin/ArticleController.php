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

    // Route model binding loads the Article whose ID appears in the edit URL.
    public function edit(Article $article)
    {
        // Pass that Article to the view so its current values can fill the form.
        return view('admin.articles.edit', compact('article'));
    }

    // Receive the edit form and update the same Article supplied by route model binding.
    public function update(Request $request, Article $article)
    {
        // Validation rules will be added in a later step.

        // Only these existing article values change; is_public remains unchanged.
        $article->update([
            'title' => $request['title'],
            'content' => $request['content'],
            'author_id' => $request['author_id'],
        ]);

        // Return the administrator to the article list after the update.
        return redirect()->route('admin.articles.index');
    }

    // Route model binding loads the Article selected by the DELETE request.
    public function destroy(Article $article)
    {
        // Permanently remove this article's database row.
        $article->delete();

        // Return the administrator to the remaining article list.
        return redirect()->route('admin.articles.index');
    }
}
