<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Support\Facades\Log;

class StaticsPolicy
{


    public function view(User $user, ?User $targetUser = null)
    {

        return $user->id > 1;

        //return true;
        // Log::error(print_r([$user, $targetUser], true));
        // return $this->isSameUser($user, $targetUser) || $this->isHisTrainer($user, $targetUser);
    }


    private function isSameUser(User $user, ?User $targetUser): bool
    {
        return !$targetUser || $user->id == $targetUser->id;
    }

    private function isHisTrainer(User $user, User $targetUser): bool
    {
        return $targetUser->trainer !== null && $targetUser->trainer->id == $user->id;
    }

}
