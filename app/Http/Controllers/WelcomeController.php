<?php
namespace App\Http\Controllers; // calss belongs to namespace App\Http\Controllers
use Illuminate\Http\Request;
class WelcomeController extends Controller
{
    public function index()
    {
        return view('welcome'); // welcome is the filename shortcut. Laravel opens: resources/views/welcome.blade.php

    }
}
