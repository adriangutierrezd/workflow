<?php

namespace App\Policies;

use App\Models\TrainerUser;
use App\Models\User;

class TrainerUserPolicy
{


    public function retrieve(User $user, User $trainer)
    {
        return $user->role->name === 'ADMIN' || ($user->role->name === 'TRAINER' && $user->id === $trainer->id);
    }


    public function store(User $user)
    {
        return $user->role->name === 'ADMIN' || $user->role->name === 'TRAINER';
    }

    public function destroy(User $user, TrainerUser $trainerUser){
        return $user->role->name === 'ADMIN' || ($user->role->name === 'TRAINER' && $user->id === $trainerUser->trainer_id);
    }


}
