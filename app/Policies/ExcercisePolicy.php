<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Excercise;

class ExcercisePolicy
{

    public function update(User $user, Excercise $excercise): bool
    {
        return $user->id == $excercise->user_id;
    }

    public function delete(User $user, Excercise $excercise): bool
    {
        return $user->id == $excercise->workout->user_id;
    }

}
