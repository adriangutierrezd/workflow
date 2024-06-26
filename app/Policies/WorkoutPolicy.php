<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Workout;
use Illuminate\Support\Facades\Log;

class WorkoutPolicy
{
    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Workout $workout): bool
    {
        return $user->id == $workout->user_id || $user->id == $workout->owner_id;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Workout $workout): bool
    {
        return $user->id == $workout->user_id || $user->id == $workout->owner_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Workout $workout): bool
    {
        return $user->id == $workout->user_id || $user->id == $workout->owner_id;
    }

    public function assign(User $user, Workout $workout): bool
    {
        return $user->role->name === 'ADMIN' || ($user->role->name === 'TRAINER' && $user->id === $workout->owner_id);
    }

}
