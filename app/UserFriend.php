<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserFriend extends Model
{
    public function user()
    {
        return $this->hasOne('App\User', 'id', 'friend_id');
    }
}
