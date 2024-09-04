<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request, Post $post)
    {
        $validatedData = $request->validate([
            'body' => 'required',
        ]);

        $post->comments()->create([
            'body' => $validatedData['body'],
            'user_id' => Auth::id(),
        ]);

        return back()->with('success', 'Comment added successfully.');
    }

    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);
        $comment->delete();
        return back()->with('success', 'Comment deleted successfully.');
    }
}
