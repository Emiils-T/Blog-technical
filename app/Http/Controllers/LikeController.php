<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{

    public function toggleLike(Request $request)
    {
        $request->validate([
            'target_id' => 'required|integer',
            'target_type' => 'required|in:App\Models\Post,App\Models\Comment',
        ]);

        $user = Auth::user();

        $targetId = $request->input('target_id');
        $targetType = $request->input('target_type');

        $like = Like::where('user_id', $user->id)
            ->where('target_id', $targetId)
            ->where('target_type', $targetType)
            ->first();

        if ($like) {
            $like->delete();
            $message = 'Unliked successfully.';
        } else {
            Like::create([
                'user_id' => $user->id,
                'target_id' => $targetId,
                'target_type' => $targetType,
            ]);
            $message = 'Liked successfully.';
        }

        return back()->with('success', $message);
    }
}
