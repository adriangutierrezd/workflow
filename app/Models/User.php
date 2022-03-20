<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
        'external_id',
        'external_auth'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
        'role',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    // Has Many
    public function workouts(){
        return $this->hasMany(Workout::class);
    }

    // Has Many
    public function clusters(){
        return $this->hasMany(Cluster::class);
    }

    // Has Many
    public function excercises(){
        return $this->hasMany(Excercise::class);
    }

    // Has Many
    public function mre_excercises(){
        return $this->hasMany(MreExcercise::class);
    }

    // Has many
    public function maximum_reps(){
        return $this->hasMany(MaximumRep::class);
    }


    // Cascade deleting
    public static function boot(){
        parent::boot();

        static::deleting(function($user){
            $user->excercises()->delete();
            $user->clusters()->delete();
            $user->workouts()->delete();
        });
    }
}
