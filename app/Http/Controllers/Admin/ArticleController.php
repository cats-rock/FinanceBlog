<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Tag;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        if(auth()->user()->is_admin) {
            $articles = Article::all();
        } else {
            $articles = Article::where('author_id', auth()->user()->id)->get();
        }

        return view('admin.articles.index', compact('articles'));
    }

    // Display the form used to enter a new article's data.
    public function create()
    {
        $tag_options = Tag::orderBy('name')->pluck('name', 'id')->toArray();

        return view('admin.articles.create', compact('tag_options'));
    }

    // Receive the submitted form data and store a new article.
    public function store(Request $request)
    {
        // Validate the Article fields and every selected Tag ID before creating anything.
         $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'author_id' => ['required', 'integer', 'exists:users,id'],
            'tags' => ['nullable', 'array'],
            'tags.*' => ['integer', 'exists:tags,id'],
        ]);

            // Use the authenticated user's ID instead of trusting an author ID submitted by the form.
            // is_public is omitted, so the database default creates a private article.
        $article = Article::create([
                'title' => $request['title'],
                'content' => $request['content'],
                'author_id' => auth()->user()->id,
            ]);

             // Save the selected Tag connections in article_tag; use an empty array when none were selected.
            $article->tags()->sync($request->input('tags', []));

            // Return to the Article management list after creating the Article and attaching its Tags.
            return redirect()->route('admin.articles.index');
    }

    // Route model binding loads the Article whose ID appears in the edit URL.
    public function edit(Article $article)
    {
        // Authentication proves who is logged in; canChange() authorizes this specific Article.
        abort_unless($article->canChange(auth()->user()), 403);

        // Retrieve every Tag so the edit form can display all available checkbox options.
        $tag_options = Tag::orderBy('name')
            ->pluck('name', 'id')
            ->toArray();

        // Pass the Article and all Tag options to the edit form.
        return view('admin.articles.edit', compact('article', 'tag_options'));
    }

    // Receive the edit form and update the same Article supplied by route model binding.
    public function update(Request $request, Article $article)
    {
        // Check authorization again because someone could submit the update URL directly.
        abort_unless($article->canChange(auth()->user()), 403);

        // Apply the same rules before changing the existing article, preserving it when validation fails.
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'author_id' => ['required', 'integer', 'exists:users,id'],
            'tags' => ['nullable', 'array'],
            'tags.*' => ['integer', 'exists:tags,id'],
        ]);

        // Only these existing article values change; is_public remains unchanged.
        $article->update([
            'title' => $request['title'],
            'content' => $request['content'],
            'author_id' => $request['author_id'],
        ]);

        // Replace the Article's Tag relationships with the Tags selected in the edit form.
        $article->tags()->sync($request->input('tags', []));

        // Return the administrator to the article list after the update.
        return redirect()->route('admin.articles.index');
    }

    // Route model binding loads the Article selected by the DELETE request.
    public function destroy(Article $article)
    {
        // Deny deletion unless the logged-in User is the author or an administrator.
        abort_unless($article->canChange(auth()->user()), 403);

        // Permanently remove this article's database row.
        $article->delete();

        // Return the administrator to the remaining article list.
        return redirect()->route('admin.articles.index');
    }
}
