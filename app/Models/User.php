<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'role_id',
        'password',
        'photo_path'
    ];

    protected $appends = [
        'image_url'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function role(){
        return $this->belongsTo(Role::class);
    }

    public function workouts(){
        return $this->hasMany(Workout::class);
    }

    public function clusters(){
        return $this->hasMany(Cluster::class);
    }

    public function trainer(){
        return $this->hasOneThrough(User::class, TrainerUser::class, 'user_id', 'id', 'id', 'trainer_id');
    }

    public function clients(){
        return $this->hasManyThrough(User::class, TrainerUser::class, 'trainer_id', 'id', 'id', 'user_id');
    }

    public function excercises(){
        return $this->hasMany(Excercise::class);
    }

    public function isTrainer(){
        return $this->role->name === 'TRAINER';
    }

    public function getImageUrlAttribute(){
        return $this->photo_path ? asset('storage/app/public/' . $this->photo_path) : $this->defaultProfilePhotoUrl();
    }

    private function defaultProfilePhotoUrl()
    {
        $name = trim(collect(explode(' ', $this->name))->map(function ($segment) {
            return mb_substr($segment, 0, 1);
        })->join(' '));

        return 'https://ui-avatars.com/api/?name='.urlencode($name).'&color=7F9CF5&background=EBF4FF';
    }

}
