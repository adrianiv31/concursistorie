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
        return $this->belongsTo('App\Grade');
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

    public function roles(){

        return $this->belongsToMany('App\Role');

    }
    public function quizzes(){

        return $this->belongsToMany('App\Quiz')->withPivot('active');

    }
    public function loggedUser()
    {
        return $this->hasOne('App\LoggedUser');

    }
    public function prof(){

        return $this->belongsTo('App\User','user_id');

    }

    public function isLogged(){

        $roles = $this->roles;

        foreach ($roles as $role)
        if($role->name == 'administrator' || $role->name == 'elev' || $role->name == 'profesor editor' || $role->name == 'profesor evaluator' || $role->name == 'profesor îndrumător'){

            return true;

        }

        return false;

    }

    public function isAdmin(){

        $roles = $this->roles;

        foreach ($roles as $role)
        if($role->name == 'administrator'){

            return true;

        }

        return false;

    }

    public function isIndrumator(){

        $roles = $this->roles;

        foreach ($roles as $role)
        if($role->name == 'profesor îndrumător'){

            return true;

        }

        return false;

    }

    public function isEditor(){

        $roles = $this->roles;

        foreach ($roles as $role)
            if($role->name == 'profesor editor'){

                return true;

            }

        return false;

    }

    public function isElev(){

        $roles = $this->roles;

        foreach ($roles as $role)
            if($role->name == 'elev'){

                return true;

            }

        return false;

    }
}
