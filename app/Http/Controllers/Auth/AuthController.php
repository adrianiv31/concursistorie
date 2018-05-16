<?php

namespace App\Http\Controllers\Auth;

use App\Judete;
use App\Localitati;
use App\Role;
use App\School;
use App\Section;
use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/admin';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'role_id'=>'required',
            'school_id'=>'required',
            'user_id'=>'required',

         //   'judete_id'=>'required',
            'localitati_id'=>'required',
            'section_id'=>'required',
            'grade_id'=>'required',

        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        if($data['role_id']==2){
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
                'judete_id' => 14,
                'localitati_id' => $data['localitati_id'],
                'school_id' => $data['school_id'],
                'user_id' => $data['user_id'],
//            'role_id' => $data['role_id'],
                'section_id'=>$data['section_id'],
                'grade_id'=>$data['grade_id'],
            ]);

            $user->roles()->sync([$data['role_id']]);

            return $user;
        }

        else if($data['role_id']==5){
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
                'judete_id' => 14,
                'localitati_id' => $data['localitati_id'],
                'school_id' => $data['school_id'],
                'user_id' => 0,
//                'role_id' => $data['role_id'],
                'section_id'=>0,
                'grade_id'=>0,
            ]);

            $user->roles()->sync([$data['role_id']]);

            return $user;
        }

    }

    public function showRegistrationForm()
    {
        $judetes = Judete::where('nume','=','Constanta')->take(1)->get();

        $localitatis = $judetes[0]->localitatis()->orderBy('nume', 'asc')->get();

        $roles = Role::where('name', '=', 'elev')->orWhere('name', '=', 'profesor îndrumător')->get();

        $schools = School::all();


        $sections = Section::all();



        return view('auth.register', compact('localitatis','sections', 'roles', 'schools'));
    }
}
