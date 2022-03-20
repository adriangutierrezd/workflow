<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaximumRep extends Model{
    use HasFactory;


    protected $guarded = ['id', 'created_at', 'updated_at'];


    public function mre_excercise(){
        return $this->belongsTo(MreExcercise::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
