<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Workout;

class WorkoutPolicy
{
    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Workout $workout): bool
    {
        return $user->id === $workout->owner_id || $user->id === $workout->owner_id;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Workout $workout): bool
    {
        return $user->id === $workout->owner_id || $user->id === $workout->owner_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Workout $workout): bool
    {
        return $user->id === $workout->owner_id || $user->id === $workout->owner_id;
    }

}
