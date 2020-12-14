<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    protected $cast = [
        "tags" => "json"
    ];

    public function image()
    {
        return $this->belongsTo('App\Image');
    }

    public function message()
    {
        return $this->hasMany('App\TopicMessage');
    }

}
