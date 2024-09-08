<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        return view('home')->with('posts', Post::latest()->limit(7)->get());
    }
}
