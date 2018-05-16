<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    //
    protected $fillable = ['name', 'grade_id', 'section_id', 'active','time','question_number'];

    public function section()
    {

        return $this->belongsTo('App\Section');

    }

    public function grade()
    {

        return $this->belongsTo('App\Grade');

    }

    public function questions(){

        return $this->belongsToMany('App\Question')->withPivot('points');

    }

    public function users(){

        return $this->belongsToMany('App\User');

    }
}
