<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Contracts\View\View;

class TagController extends Controller
{
    // Display every Tag and count only the public Articles connected to it.
    public function index(): View
    {
        $tags = Tag::query()
            // A Tag may have zero public Articles, so keep every Tag but filter its displayed count.
            ->withCount([
                'articles as articles_count' => function ($query) {
                    $query->where('is_public', true);
                },
            ])
            ->orderBy('name')
            ->get();

        return view('tags.index', compact('tags'));
    }

    // Display one Tag and only the related Articles that public readers may see.
    public function show(Tag $tag): View
    {
        $tag->loadCount([
            'articles as articles_count' => function ($query) {
                $query->where('is_public', true);
            },
        ]);

        $articles = $tag->articles()
            ->where('is_public', true)
            // Preload each public Article's User so the view can display its author efficiently.
            ->with('author')
            ->latest()
            ->get();

        return view('tags.show', compact('articles', 'tag'));
    }
}
