<?php

namespace App\Policies;

use App\Models\ThreadComment;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ThreadCommentPolicy
{
    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, ThreadComment $threadComment): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, ThreadComment $threadComment): bool
    {
        return $user->id === $threadComment->user_id;
    }

}
