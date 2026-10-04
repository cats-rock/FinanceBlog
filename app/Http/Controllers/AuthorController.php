<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\View;

class AuthorController extends Controller
{
    // Display only Users who qualify as public authors by having at least one public Article.
    public function index(): View
    {
        $authors = User::query()
            ->whereHas('articles', function ($query) {
                $query->where('is_public', true);
            })
            // Count only public Articles so private work is not revealed on the public page.
            ->withCount([
                'articles as articles_count' => function ($query) {
                    $query->where('is_public', true);
                },
            ])
            ->orderBy('name')
            ->get();

        return view('authors.index', compact('authors'));
    }

    // Display one author and the public Articles that readers are allowed to see.
    public function show(User $user): View
    {
        $author = $user->loadCount([
            'articles as articles_count' => function ($query) {
                $query->where('is_public', true);
            },
        ]);

        // A User without public Articles should not have a public author page.
        abort_if($author->articles_count === 0, 404);

        $articles = $user->articles()
            ->where('is_public', true)
            // FinanceBlog uses Tags instead of the teacher project's Keywords.
            ->with('tags')
            ->latest()
            ->get();

        return view('authors.show', compact('author', 'articles'));
    }
}
