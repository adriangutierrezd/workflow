<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Cluster;

class ClusterPolicy
{

    public function update(User $user, Cluster $cluster): bool
    {
        return $user->id == $cluster->workout->user_id || $user->id == $cluster->workout->owner_id;
    }

    public function delete(User $user, Cluster $cluster): bool
    {
        return $user->id == $cluster->workout->user_id || $user->id == $cluster->workout->owner_id;
    }

}
