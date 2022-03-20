<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MreExcercise extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function excercise(){
        return $this->belongsTo(Excercise::class);
    }

    // Has many
    public function maximum_reps(){
        return $this->hasMany(MaximumRep::class);
    }

}
