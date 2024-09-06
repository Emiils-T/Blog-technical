<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->paginate(13);
        return view('posts.index', compact('posts'));
    }
    public function show(string $id)
    {
        $id = intval($id);
        $post = Post::where('id', $id)->first();
        $comments = $post->comments()->with('user')->latest()->get();
        $categories = $post->categories;
        return view('posts.show',compact
        (
            'post',
            'categories',
            'comments'
        ));
    }


    public function create()
    {
        return view('posts.create');
    }
    public function store(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        $validatedData = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'body' => ['required'],
        ]);

        $user->posts()->create([
            'title' => $validatedData['title'],
            'body' => $validatedData['body'],
            'author_name' => $user->name,
        ]);

        return redirect()->route('posts.index');
    }
    public function edit(Post $post)
    {
        return view('posts.edit',compact('post'));
    }
    public function update(Request $request, Post $post)
    {
        if (Auth::id() !== $post->user_id)
        {
            abort(403);
        }

        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
        ]);

        $post->update($validatedData);

        return redirect()->route('posts.show', $post);
    }
    public function destroy(Post $post)
    {
        if (Auth::id() !== $post->user_id) {
            abort(403);
        }
        $post->delete();
        return redirect()->route('posts.index');

    }
}
