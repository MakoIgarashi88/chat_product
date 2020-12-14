<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    public function image()
    {
        return $this->belongsTo('App\Image');
    }

    public function members()
    {
        return $this->belongsToMany('App\User', 'group_users', 'group_id', 'user_id');
    }

    public function friends()
    {
        return $this->belongsToMany('App\User', 'user_friends', 'user_id', 'friend_id');
    }

}
