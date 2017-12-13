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
        'name', 'email', 'password', 'judete_id', 'localitati_id', 'unitate', 'profesor', 'role_id', 'section_id', 'grade_id'

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

    public function section()
    {
        return $this->hasOne('App\Section');
    }
}
