<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainerUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'trainer_id'
    ];

     public function getCreatedAtAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format('d/m/Y');
    }

    public function trainer(){
        return $this->belongsTo(User::class, 'id', 'trainer_id');
    }

    public function clients(){
        return $this->hasMany(User::class, 'id', 'user_id');
    }

}
