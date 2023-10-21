<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkoutStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function workouts(){
        return $this->hasMany(Workout::class, 'status_id');
    }

}
