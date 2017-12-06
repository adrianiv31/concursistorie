<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Localitati extends Model
{
    //
    public function judete(){

        return $this->belongsTo('App\Judetes');

    }
}
