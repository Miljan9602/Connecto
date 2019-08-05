<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Friendship extends Model
{
    protected $table = 'friendships';

    protected $hidden = ['created_at', 'id', 'updated_at', 'user_id', 'follower_id'];

    public function follower(){
        return $this->belongsTo('App\User', 'follower_id', 'id', 'users');
    }

    public function user() {
        return $this->belongsTo('App\User', 'user_id', 'id', 'users');
    }
}
