<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SearchController extends Controller
{
    public function search(Request $request): View
    {
        $validatedData = $request->validate([
            'query' => 'required',
        ]);

        $query = $validatedData['query'];

        $posts = Post::where('title', 'LIKE', "%{$query}%")
            ->orWhere('body', 'LIKE', "%{$query}%")
            ->paginate(10);

        return view('search.results', compact('posts', 'query'));
    }
}
