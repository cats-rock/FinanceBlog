<?php

namespace App\Http\Controllers;

// Import the Tool model so this controller can query the tools table.
use App\Models\Tool;

class ToolController extends Controller
{
    // The tools.index route calls index() when a visitor opens /tools.
    public function index()
    {
        // Retrieve only public tools and store the resulting collection in $tools.
        $tools= Tool::where('is_public', true)->get();

        // Load tools/index.blade.php and pass the tools collection to the view.
        return view('tools.index', compact('tools'));
    }
     // Route model binding finds the Tool that matches {tool} in the URL, or returns 404.
    public function show(Tool $tool)
    {
        // Return 404 for a private tool, even when a visitor enters its URL directly.
        abort_unless($tool->is_public, 404);

        // Load tools/show.blade.php and pass the selected tool to the view.
        return view('tools.show', compact('tool'));

        
    }
}
