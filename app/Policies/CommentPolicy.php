<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\User;

class CommentPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function create(User $user)
    {
        return $user->isAuthenticated();
    }

    public function edit(User $user, Comment $comment)
    {
        // Only the comment owner can edit the comment
        return $user->id === $comment->user_id;
    }

    public function delete(User $user, Comment $comment)
    {
        // Only the comment owner or admin can delete the comment
        return $user->id === $comment->user_id  || $user->isAdmin();
    }
}
