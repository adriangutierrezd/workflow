<?php

namespace App\Policies;

use App\Models\TrainerUser;
use App\Models\User;

class TrainerUserPolicy
{

    private function isAdmin(User $user){
        return $user->role->name === 'ADMIN';
    }

    private function isTrainer(User $user){
        return $user->role->name === 'TRAINER';
    }

    public function view(User $user){
        return $this->isAdmin($user) || $this->isTrainer($user);
    }

    public function retrieve(User $user, User $trainer)
    {
        return $user->role->name === 'ADMIN' || ($user->role->name === 'TRAINER' && $user->id === $trainer->id);
    }

    public function store(User $user)
    {
        return $this->isAdmin($user) || $this->isTrainer($user);
    }

    public function destroy(User $user, TrainerUser $trainerUser){
        return $user->role->name === 'ADMIN' || ($user->role->name === 'TRAINER' && $user->id === $trainerUser->trainer_id);
    }

    public function getPossibleClients(User $user){
        return $this->isAdmin($user) || $this->isTrainer($user);
    }


}
