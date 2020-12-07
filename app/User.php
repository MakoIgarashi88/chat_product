<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'nickname', 'password', 'api_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'api_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function image()
    {
        return $this->belongsTo('App\Image');
    }

    public function groups()
    {
        return $this->belongsToMany('App\Group', 'group_users', 'user_id', 'group_id');
    }
    public function friends()
    {
        return $this->belongsToMany('App\User', 'user_friends', 'user_id', 'friend_id');
    }
    public function topics()
    {
        return $this->belongsToMany('App\Topic', 'favorite_topics', 'user_id', 'topic_id');
    }

}
