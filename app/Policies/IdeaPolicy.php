<?php

namespace App\Policies;

use App\Models\Idea;
use App\Models\User;

class IdeaPolicy
{
    public function update(User $user, Idea $idea): bool
    {
        return $idea->user_id === $user->id && $idea->status === 'Soumise';
    }

    public function delete(User $user, Idea $idea): bool
    {
        return $idea->user_id === $user->id && $idea->status === 'Soumise';
    }
}
