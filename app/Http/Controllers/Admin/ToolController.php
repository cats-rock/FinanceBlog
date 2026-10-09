<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tool;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ToolController extends Controller
{
    // Display all Tools, including private ones, to administrators.
    public function index()
    {
        abort_unless(auth()->user()->is_admin, 403);

        $tools = Tool::all();

        return view('admin.tools.index', compact('tools'));

    }

    // Display the empty Tool creation form for administrators.
    public function create()
    {
        abort_unless(auth()->user()->is_admin, 403);

        return view('admin.tools.create');
    }

    // Display the editing form for the Tool loaded through route model binding.
    public function edit(Tool $tool): View
    {
        abort_unless(auth()->user()->is_admin, 403);

        return view('admin.tools.edit', compact('tool'));
    }

    // Validate and save only the Tool details that administrators can edit.
    public function update(Request $request, Tool $tool): RedirectResponse
    {
        abort_unless($request->user()->is_admin, 403);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'is_public' => ['required', 'boolean'],
        ]);

        $tool->update($validated);

        return redirect()->route('admin.tools.index');
    }
}
