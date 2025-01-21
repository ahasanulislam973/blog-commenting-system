<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Comment;


class CommentPolicy
{
    /**
     * Determine if the user can update the comment.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Comment  $comment
     * @return bool
     */
    public function update(User $user, Comment $comment)
    {
        // A user can update their own comment
        return $user->id === $comment->user_id;
    }

    /**
     * Determine if the user can delete the comment.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Comment  $comment
     * @return bool
     */
    public function delete(User $user, Comment $comment)
    {
        // A user can delete their own comment or the comment on their own post
        return $user->id === $comment->user_id || $user->id === $comment->post->user_id;
    }
}
