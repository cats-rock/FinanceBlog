<?php

// This namespace tells PHP that the controller belongs to the application's controllers folder.
namespace App\Http\Controllers; // calss belongs to namespace App\Http\Controllers

// Request represents data sent by the browser. It is imported here but is not used yet.
use Illuminate\Http\Request;

// This controller receives homepage requests from the route in routes/web.php.
class WelcomeController extends Controller
{
    // The route calls this public method when someone visits the homepage.
    public function index()
    {
        // The response flow is: route -> controller -> welcome Blade view -> browser.
        return view('welcome'); // welcome is the filename shortcut. Laravel opens: resources/views/welcome.blade.php
    }
}
