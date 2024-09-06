<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class CommentPolicy
{
    use HandlesAuthorization;

    public function create(): bool
    {
        return Auth::id() !== null;
    }
    public function update(User $user,Comment $comment): bool
    {
        return $user->id === $comment->user_id;
    }

    public function delete(User $user,Comment $comment): bool
    {
        return $user->id === $comment->user_id;
    }
}
