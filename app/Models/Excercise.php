<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Excercise extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    // Has Many (Reverse)
    public function excercise_category(){
        return $this->belongsTo(ExcerciseCategory::class);
    }

    // Has many
    public function clusters(){
        return $this->hasMany(Cluster::class);
    }

    // Has one
    public function mre_excercise(){
        return $this->hasOne(MreExcercise::class);
    }

    // Has Many (reverse)
    public function user(){
        return $this->belongsTo(User::class);
    }
}
