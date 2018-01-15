<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'judete_id', 'localitati_id', 'school_id', 'user_id', 'role_id', 'section_id', 'grade_id', 'active'

    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function grade()
    {
        return $this->hasOne('App\Grade');
    }

    public function school()
    {
        return $this->belongsTo('App\School');
    }

    public function section()
    {
        return $this->belongsTo('App\Section');
    }

    public function judete()
    {
        return $this->belongsTo('App\Judete');

    }
    public function localitati()
    {
        return $this->belongsTo('App\Localitati');

    }

    public function role(){

        return $this->belongsTo('App\Role');

    }

    public function prof(){

        return $this->belongsTo('App\User','user_id');

    }

    public function isAdmin(){

        if($this->role->name == 'administrator'){

            return true;

        }

        return false;

    }
}
