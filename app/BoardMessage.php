<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BoardMessage extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
