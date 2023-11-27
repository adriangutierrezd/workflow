<?php

namespace App\Providers;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define('see-statics', function (User $user, ?User $targetUser = null): bool 
        {
            
            $isSameUser = !$targetUser || $user->id == $targetUser->id;

            if($isSameUser) return true;

            $trainerId = $targetUser->trainer?->id;
            $isHisTrainer = $trainerId !== null && $trainerId == $user->id; 
                
            return $isHisTrainer;
        });

    }
}
