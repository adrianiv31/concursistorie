<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Judete extends Model
{
    //
    public function localitatis(){

        return $this->hasMany('App\Localitati');

    }
}
