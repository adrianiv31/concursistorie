<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    //
    public $directory = '/images/';
    protected $fillable = ['question_id', 'raspuns', 'path','corect'];

    public function question()
    {

        return $this->belongsTo('App\Question');

    }

    public function getPathAttribute($value)
    {
        return $this->directory . $value;
    }
}
