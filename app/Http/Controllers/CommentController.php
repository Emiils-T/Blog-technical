<?php

namespace App\Http\Controllers;

use App\Helpers\XssPreventionHelper;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, Post $post): RedirectResponse
    {
        $validatedData = $request->validate([
            'body' => 'required',
        ]);
        $cleanedBody = XssPreventionHelper::sanitizeHtml($validatedData['body']);

        $post->comments()->create([
            'body' => $cleanedBody,
            'user_id' => Auth::id(),
        ]);

        return back();
    }

    public function update(Request $request, Post $post, Comment $comment)
    {
        if ($comment->post_id !== $post->id) {
            abort(404);
        }

        $validatedData = $request->validate([
            'body' => 'required|string|max:1000',
        ]);

        $cleanedBody = XssPreventionHelper::sanitizeHtml($validatedData['body']);

        $comment->update([
            'body' => $cleanedBody
        ]);

        return back();
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();
        return back();
    }
}
