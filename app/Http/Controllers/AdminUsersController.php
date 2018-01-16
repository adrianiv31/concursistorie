<?php

namespace App\Http\Controllers;

use App\Grade;
use App\Http\Requests\UserEditRequest;
use App\Http\Requests\UserRequest;
use App\Judete;
use App\Role;
use App\School;
use App\Section;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //$users = User::all()->sortBy(['role_id','name']);

        $users = User::all()->sortBy(function ($item) {
            return $item->role_id . '-' . $item->name;
        });
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $roles = Role::where('id', '!=', 2)->lists('name', 'id')->all();

        $judetes = Judete::where('nume', '=', 'Constanta')->take(1)->get();
        $localitatis = $judetes[0]->localitatis()->orderBy('nume', 'asc')->lists('nume', 'id')->all();

        $schools = School::lists('name', 'id')->all();

        $sections = Section::lists('name', 'id')->all();

        return view('admin.users.create', compact('roles', 'localitatis', 'schools', 'sections'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        //
        $tiputilizator = $request['tiputilizator'];

        if ($tiputilizator == 2)
            $input = $request->except('tiputilizator', 'roles');
        else {
            $roles = $request['roles'];
            $input = $request->except('tiputilizator', 'roles');
        }


        $input['password'] = bcrypt($request->password);
        $input['judete_id'] = 14;


//        foreach ($roles as $role)
//            echo $role;
//        return $input;exit;


        $user = User::create($input);

        if ($tiputilizator == 2)
            $user->roles()->sync([2]);
        else
            $user->roles()->sync($roles);

        return redirect(route('admin.users.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return view('admin.users.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $user = User::findOrFail($id);

        $roles = Role::where('id', '!=', 2)->lists('name', 'id')->all();
        $judetes = Judete::where('nume', '=', 'Constanta')->take(1)->get();
        $localitatis = $judetes[0]->localitatis()->orderBy('nume', 'asc')->lists('nume', 'id')->all();


        $role_id = Role::where('name', '=', 'profesor îndrumător')->take(1)->get();
        $schools = School::lists('name', 'id')->all();

        $profesori = User::where([

                ['school_id', '=', $user->school_id],
                ['role_id', '=', $role_id[0]->id],
            ]
        )->lists('name', 'id')->all();

//        echo $user->school_id;
//        foreach($profesori as $prof)echo $prof."<br>";exit;

        $sections = Section::lists('name', 'id')->all();

        if (!is_null($user->section)) {
            if ($user->section->name == 'Gimnaziu') $grades = Grade::where('name', '=', 'V')->lists('name', 'id')->all();
            else $grades = Grade::where('name', 'like', '%X%')->lists('name', 'id')->all();
        } else {
            $grades = Grade::lists('name', 'id')->all();
        }
        return view('admin.users.edit', compact('user', 'roles', 'localitatis', 'schools', 'sections', 'profesori', 'grades'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserEditRequest $request, $id)
    {
        //
        $user = User::findOrFail($id);

        $tiputilizator = $request['tiputilizator'];

        if ($tiputilizator == 2) {

            if (!$request->has('password')) {
                $input = $request->except('tiputilizator', 'roles', 'password');


            } else {
                $input = $request->except('tiputilizator', 'roles');
                $input['password'] = bcrypt($request->password);

            }
        } else {

            $roles = $request['roles'];
            if (!$request->has('password')) {
                $input = $request->except('tiputilizator', 'roles', 'password');


            } else {
                $input = $request->except('tiputilizator', 'roles');
                $input['password'] = bcrypt($request->password);

            }


        }




        $user->update($input);

        if ($tiputilizator == 2)
            $user->roles()->sync([2]);
        else
            $user->roles()->sync($roles);

        return redirect(route('admin.users.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $user = User::findOrFail($id);

        $elevi = User::where('user_id', '=', $id)->get();


        foreach ($elevi as $elev) {

            echo $elev->delete();

        }

        $user->roles()->detach();
        $user->delete();
        return redirect(route('admin.users.index'));
    }
}
