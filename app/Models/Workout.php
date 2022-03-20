<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workout extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    // Has Many
    public function clusters(){
        return $this->hasMany(Cluster::class);
    }

    // Has Many (reverse)
    public function user(){
        return $this->belongsTo(User::class);
    }

    // Cascade deleting
    public static function boot(){
        parent::boot();

        static::deleting(function($workout){
            $workout->clusters()->delete();
        });
    }
}
