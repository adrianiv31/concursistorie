<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    //
    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    public function questions(){

        return $this->hasMany('App\Question');
    }
}
