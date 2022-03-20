<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cluster extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    // Has Many (reverse)
    public function excercise(){
        return $this->belongsTo(Excercise::class);
    }

    // Has Many (Reverse)
    public function workout(){
        return $this->belongsTo(Workout::class);
    }

    // Has Many (reverse)
    public function user(){
        return $this->belongsTo(User::class);
    }
}