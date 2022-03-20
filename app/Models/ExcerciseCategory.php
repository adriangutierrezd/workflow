<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExcerciseCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    // Has Many
    public function excercises(){
        return $this->hasMany(Excercise::class);
    }

    // Cascade deleting
    public static function boot(){
        parent::boot();

        static::deleting(function($excercisecategory){
            $excercisecategory->excercises()->delete();
        });
    }
}
