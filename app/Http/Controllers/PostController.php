<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }
    public function index()
    {
        $posts = Post::all();
        return view('posts.index', compact('posts'));
    }
    public function show(int $id)
    {
        $post = Post::where('id', $id)->first();
        return view('post.show',compact('post'));
    }
}
