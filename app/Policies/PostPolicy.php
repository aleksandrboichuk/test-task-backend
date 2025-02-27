<?php

namespace App\Policies;

use App\Models\LuckyPage;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PostPolicy
{
    /**
     * Determine if the given post can be updated by the user.
     *
     * @param User $user
     * @param LuckyPage $post
     * @return Response
     */
    public function update(User $user, LuckyPage $post): Response
    {
        return $user->id === $post->created_by
            ? Response::allow()
            : Response::deny('You do not own this post.');
    }
}
