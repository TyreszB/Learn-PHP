<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Follow extends Model
{
    use HasFactory;

    public function followingUser() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function userFollowed() {
        return $this->belongsTo(User::class, 'followeduser');
    }
}
