<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workout extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'owner_id',
        'title',
        'status_id',
        'note',
        'date'
    ];


    public function user(){
        return $this->belongsTo(User::class);
    }

    public function owner(){
        return $this->belongsTo(User::class);
    }

    public function status(){
        return $this->belongsTo(WorkoutStatus::class, 'status_id');
    }

}
