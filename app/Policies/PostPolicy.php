<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;


class PostPolicy
{
    /**
     * Determine if the user can update the post.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Post  $post
     * @return bool
     */
    public function update(User $user, Post $post)
    {
        // A user can update their own post
        return $user->id === $post->user_id;
    }

    /**
     * Determine if the user can delete the post.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Post  $post
     * @return bool
     */
    public function delete(User $user, Post $post)
    {
        // A user can delete their own post
        return $user->id === $post->user_id;
    }
}
