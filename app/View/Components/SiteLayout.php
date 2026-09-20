<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

// This class connects the <x-site-layout> Blade tag to its shared layout view.
class SiteLayout extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        // Laravel translates this view name to resources/views/components/site-layout.blade.php.
        return view('components.site-layout');
    }
}
