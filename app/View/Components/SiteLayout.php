<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

// This class connects the <x-site-layout> Blade tag to its shared layout view.
class SiteLayout extends Component
{
    /**
     * Each menu item stores its label, URL, and route pattern for the active-link style.
     *
     * @var list<array{label: string, link: string, match: string}>
     */
    public array $menu;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->menu = [
            ['label' => 'Home', 'link' => route('home'), 'match' => 'home'],
            ['label' => 'Articles', 'link' => route('articles.index'), 'match' => 'articles.*'],
            ['label' => 'Author', 'link' => route('authors.index'), 'match' => 'authors.*'],
            ['label' => 'Tags', 'link' => route('tags.index'), 'match' => 'tags.*'],
            ['label' => 'Tools', 'link' => route('tools.index'), 'match' => 'tools.*'],
        ];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        // The layout was moved from components/site-layout.blade.php to layouts/site.blade.php.
        return view('layouts.site');
    }
}
