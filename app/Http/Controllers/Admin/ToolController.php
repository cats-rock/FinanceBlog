<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tool;

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
}
