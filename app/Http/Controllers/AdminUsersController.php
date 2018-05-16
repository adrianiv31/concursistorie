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

    public function import()
    {
        return view('admin.users.import');
    }

    public function importUsr(Request $request)
    {

        if ($file = $request->file('file')) {


            $name = time() . $file->getClientOriginalName();


            $file->move('tmpfile', $name);

            $handle = fopen('./tmpfile/' . $name, "r");
            if ($handle) {
                while (($line = fgets($handle)) !== false) {
                    // process the line read.
                    $tok = strtok($line, "$");
                    $judet = mb_strtoupper($tok);

                    $tok = strtok("$");
                    $scoala = mb_strtoupper($tok);

                    $tok = strtok("$");
                    $nume = mb_strtoupper($tok);
                    $email = str_replace(' ', '', mb_strtolower($nume) . "@istorie.ro");

                    $tok = strtok("$");
                    $clasa = mb_strtoupper($tok);

                    $tok = strtok("$");
                    $profesor = mb_strtoupper($tok);
                    $emailProf = str_replace(' ', '', mb_strtolower($profesor) . "@istorie.ro");

                    $tok = strtok("$");
                    echo $judet . " " . $scoala . " " . $nume . " " . $clasa . " " . $profesor . " " . $email . "<br>";

                    $judetDB = Judete::where([

                        ['nume', '=', $judet],

                    ])->get();
                    if ($judetDB) {

                        echo $judetDB[0]->nume_seo . "<br>";
                        $localitati = $judetDB[0]->localitatis->all();
                        echo $localitati[0]->nume;
                        $judet_id = $judetDB[0]->id;
                        $localitati_id = $localitati[0]->id;
                        $section_id = 1;

                        $gradeDb = Grade::where([
                            ['name', '=', $clasa],
                        ])->first();

                        $grade_id = $gradeDb->id;

                        $scoalaDb = School::where([
                            ['name', '=', $scoala],
                        ])->first();

                        if ($scoalaDb) {
                            $school_id = $scoalaDb->id;
                        } else {
                            $scoalaDb = new School;
                            $scoalaDb->name = $scoala;
                            $scoalaDb->localitati_id = $localitati_id;

                            $scoalaDb->save();
                            $school_id = $scoalaDb->id;
                        }

                        $profDb = User::where([
                            ['name', '=', $profesor],
                            ['school_id', '=', $school_id],
                            ['judete_id', '=', $judet_id],
                        ])->first();
                        if ($profDb) {
                            $user_id = $profDb->id;
                            $profDb->roles()->sync([5]);
                        } else {
                            $profIndrumator = new User;
                            $profIndrumator->name = $profesor;
                            $profIndrumator->email = $emailProf;
                            $profIndrumator->password = bcrypt("calator2018prof");
                            $profIndrumator->judete_id = $judet_id;
                            $profIndrumator->localitati_id = $localitati_id;
                            $profIndrumator->section_id = $section_id;
                            $profIndrumator->grade_id = $grade_id;
                            $profIndrumator->school_id = $school_id;

                            $profIndrumator->save();
                            $user_id = $profIndrumator->id;
                            $profIndrumator->roles()->sync([5]);
                        }

                        $userDb = User::where([
                            ['name', '=', $nume],
                            ['school_id', '=', $school_id],
                            ['judete_id', '=', $judet_id],
                            ['grade_id', '=', $grade_id],
                        ])->first();
                        if ($userDb) {
                            $userDb->roles()->sync([2]);
                        } else {
                            $user = new User;
                            $user->name = $nume;
                            $user->email = $email;
                            $user->password = bcrypt("calator2018");
                            $user->judete_id = $judet_id;
                            $user->localitati_id = $localitati_id;
                            $user->section_id = $section_id;
                            $user->grade_id = $grade_id;
                            $user->school_id = $school_id;
                            $user->user_id = $user_id;
                            $user->save();
                            $user->roles()->sync([2]);
                        }


                    } else {
                        echo $judet . " nu exista <br>";
                    }
                }

                fclose($handle);
            } else {
                // error opening the file.
            }

        }
        return redirect(route('admin.users.index'));
    }
    public function export()
    {
        $users = User::all();


        foreach ($users as $user)
        {
$roles = $user->roles;
$k=0;
foreach ($roles as $role)
    if($role->name == 'elev') $k=1;

if($k==1){
    $row = $user->judete->nume.','.$user->name.','.$user->email.',calator2018';echo $row."<br>";
}


        }
       // return view('admin.users.import');
    }

}
