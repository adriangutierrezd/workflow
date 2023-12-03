<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class UserTrainerRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'trainer_id',
        'message',
        'accepted',
        'token',
        'token_expires_at'
    ];


    public function isExpired(){
        $now = Carbon::now();
        return !$now->lt($this->token_expires_at);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function trainer(){
        return $this->belongsTo(User::class, 'trainer_id', 'id');
    }

}
