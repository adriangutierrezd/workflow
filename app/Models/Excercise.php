<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Excercise extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'user_id'
    ];

    public function clusters(){
        return $this->hasMany(Cluster::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }


}
