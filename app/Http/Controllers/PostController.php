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
        $posts = Post::all();
        return view('posts.index', compact('posts'));
    }
    public function show(string $id)
    {
        $id = intval($id);
        $post = Post::where('id', $id)->first();
        $categories = $post->categories;
        return view('posts.show',compact('post','categories'));
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
    public function edit()
    {
        return view('posts.edit');
    }
    public function update(Request $request, Post $post)
    {
        // Authorize the request
        $this->authorize('update', $post);

        // Validate the request
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
            // Add any other fields you want to update
        ]);

        // Update the post
        $post->update($validatedData);

        // Redirect to the updated post with a success message
        return redirect()->route('posts.show', $post)
            ->with('success', 'Post updated successfully');
    }
    public function destroy(string $id)
    {
        $user = Auth::user();

        $post=Post::where('id', $id)->get();

        if($post->user_id === $user->id){
            abort(403);
        }
        $post->delete();
        return redirect()->route('posts.index');

    }
}
