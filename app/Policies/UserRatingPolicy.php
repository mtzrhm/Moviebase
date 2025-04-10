<?php

namespace App\Policies;

use App\Models\User;
use App\Models\UserRating;
use Illuminate\Auth\Access\Response;

class UserRatingPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->exists();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, UserRating $userRating): Response
    {
        return $user->id === $userRating->user_id
            ? Response::allow()
            : Response::deny();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->exists();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, UserRating $userRating): Response
    {
        return $user->id === $userRating->user_id
            ? Response::allow()
            : Response::deny();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, UserRating $userRating): Response
    {
        return $user->id === $userRating->user_id
            ? Response::allow()
            : Response::deny();
    }

    // theoretisch restore and forceDelete, aber ohne SoftDeletes nicht notwendig
}
