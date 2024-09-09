<?php

namespace App\Http\Controllers;

use App\Helpers\XssPreventionHelper;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class PostController extends Controller
{
    public function index(): View
    {
        $posts = Post::latest()->paginate(13);
        return view('posts.index', compact('posts'));
    }

    public function show(string $id): View
    {
        $id = intval($id);
        $post = Post::where('id', $id)->first();
        $comments = $post->comments()->with('user')->latest()->get();
        $categories = $post->categories;
        return view('posts.show', compact
        (
            'post',
            'categories',
            'comments'
        ));
    }


    public function create(): View
    {
        $categories = Category::all();
        return view('posts.create', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'categories' => 'array',
            'categories.*' => 'integer|exists:categories,id',
            'new_categories' => 'nullable|string',
        ]);

        $post = new Post;
        $post->title = $validatedData['title'];
        $post->body = $validatedData['body'];
        $post->author_name = Auth::user()->name;
        $post->user_id = Auth::id();
        $post->save();

        $categoryIds = $validatedData['categories'] ?? [];

        $newCategoryNames = array_filter($request->input('categories', []), function ($value) {
            return !is_numeric($value);
        });

        if (!empty($validatedData['new_categories'])) {
            $newCategoryNames = array_merge($newCategoryNames, array_map('trim', explode(',', $validatedData['new_categories'])));
        }

        foreach ($newCategoryNames as $name) {
            $category = Category::firstOrCreate(['name' => $name]);
            $categoryIds[] = $category->id;
        }

        $post->categories()->sync($categoryIds);

        return redirect()->route('posts.show', $post);
    }

    public function edit(Post $post): View
    {
        $categories = Category::all();
        return view('posts.edit', compact('post', 'categories'));
    }

    public function update(Request $request, Post $post): RedirectResponse
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'categories' => 'array',
            'categories.*' => 'integer|exists:categories,id',
            'new_categories' => 'nullable|string',
        ]);

        $post->update([
                'title' => $validatedData['title'],
                'body' => $validatedData['body']]
        );

        $categoryIds = $validatedData['categories'] ?? [];

        $newCategoryNames = array_filter($request->input('categories', []), function ($value) {
            return !is_numeric($value);
        });

        if (!empty($validatedData['new_categories'])) {
            $newCategoryNames = array_merge($newCategoryNames, array_map('trim', explode(',', $validatedData['new_categories'])));
        }

        foreach ($newCategoryNames as $name) {
            $category = Category::firstOrCreate(['name' => $name]);
            $categoryIds[] = $category->id;
        }

        $post->categories()->sync($categoryIds);

        return redirect()->route('posts.show', $post);
    }

    public function destroy(Post $post): RedirectResponse
    {
        if (Auth::id() !== $post->user_id) {
            abort(403);
        }
        $post->delete();
        return redirect()->route('posts.index');

    }
}
