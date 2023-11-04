<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cluster extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'owner_id',
        'workout_id',
        'excercise_id',
        'sets',
        'reps',
        'weight',
        'unit',
        'done'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function workout()
    {
        return $this->belongsTo(Workout::class);
    }

    public function excercise(){
        return $this->belongsTo(Excercise::class);
    }

}
