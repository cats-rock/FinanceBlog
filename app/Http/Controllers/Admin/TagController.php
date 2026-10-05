<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TagController extends Controller
{
    // Display every Tag in the admin management list.
    public function index()
    {
        $tags = Tag::all();

        return view('admin.tags.index', compact('tags'));
    }

    // Display an empty form for creating a Tag.
    public function create()
    {
        return view('admin.tags.create');
    }

    // Validate the submitted name and create the Tag.
    public function store(Request $request)
    {
        $request->validate([
            // A Tag name must be unique so the same category is not created twice.
            'name' => ['required', 'string', 'max:255', 'unique:tags,name'],
        ]);

        Tag::create([
            'name' => $request['name'],
        ]);

        return redirect()->route('admin.tags.index');
    }

    // Display the form for the Tag loaded through route model binding.
    public function edit(Tag $tag)
    {
        return view('admin.tags.edit', compact('tag'));
    }

    // Validate and save the edited Tag name.
    public function update(Request $request, Tag $tag)
    {
        $request->validate([
            // Ignore this Tag's own row so keeping its current name remains valid.
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('tags', 'name')->ignore($tag),
            ],
        ]);

        $tag->update([
            'name' => $request['name'],
        ]);

        return redirect()->route('admin.tags.index');
    }

    // Remove the Tag and its Article connections.
    public function destroy(Tag $tag)
    {
        // The pivot migration has no cascade rule, so remove article_tag rows explicitly.
        $tag->articles()->detach();
        $tag->delete();

        return redirect()->route('admin.tags.index');
    }
}
