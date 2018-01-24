<?php

namespace App\Http\Controllers;

use App\Grade;
use App\Http\Requests\IndrumatorEditRequest;
use App\Http\Requests\IndrumatorRequest;
use App\Judete;
use App\Quiz;
use App\Role;
use App\School;
use App\Section;
use App\StudentAnswer;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class AdminIndrumatoriController extends Controller
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

        $users = User::where('user_id','=',Auth::user()->id)->get()->sortBy(function($item) {
            return $item->role_id.'-'.$item->name;
        });
        return view('admin.indrumatori.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //


        $judetes = Judete::where('nume', '=', 'Constanta')->take(1)->get();
        $localitatis = $judetes[0]->localitatis()->orderBy('nume', 'asc')->lists('nume', 'id')->all();



        $sections = Section::lists('name', 'id')->all();

        return view('admin.indrumatori.create', compact( 'localitatis', 'sections'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(IndrumatorRequest $request)
    {
        //
        $input = $request->all();

        $input['password'] = bcrypt($request->password);
        $input['judete_id'] = 14;

        $role = Role::where('name', '=', 'elev')->take(1)->get();
//        $input['role_id']=$role[0]->id;
        $input['active']=0;

        $user_id=Auth::user()->id;
        $school_id=Auth::user()->school->id;

        $input['user_id']=$user_id;
        $input['school_id']=$school_id;


        $user = User::create($input);

        $user->roles()->sync([$role[0]->id]);
        return redirect(route('admin.indrumatori.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $user = User::findOrFail($id);


        $judetes = Judete::where('nume', '=', 'Constanta')->take(1)->get();
        $localitatis = $judetes[0]->localitatis()->orderBy('nume', 'asc')->lists('nume', 'id')->all();




//        echo $user->school_id;
//        foreach($profesori as $prof)echo $prof."<br>";exit;

        $sections = Section::lists('name', 'id')->all();

        if (!is_null($user->section)) {
            if ($user->section->name == 'Gimnaziu') $grades = Grade::where('name', '=', 'V')->lists('name', 'id')->all();
            else $grades = Grade::where('name', 'like', '%X%')->lists('name', 'id')->all();
        } else {
            $grades = Grade::lists('name','id')->all();
        }
        return view('admin.indrumatori.edit', compact('user',  'localitatis',  'sections',  'grades'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(IndrumatorEditRequest $request, $id)
    {
        //
        $user = User::findOrFail($id);


        if(!$request->has('password')){

            $input = $request->except('password');

        }else{
            $input = $request->all();
            $input['password'] = bcrypt($request->password);

        }





        $user->update($input);



        return redirect(route('admin.indrumatori.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $user = User::findOrFail($id);


        $user->delete();
        return redirect(route('admin.indrumatori.index'));
    }

    public function rezultate($id){

        $elev = User::findOrFail($id);

        $teste = Quiz::where([

                ['section_id', '=', $elev->section_id],
                ['grade_id', '=', $elev->grade_id],
            ]
        )->get();


        foreach($teste as $test){

            $ras_date = StudentAnswer::where([
                ['quiz_id', '=', $test->id],
                ['user_id', '=', $elev->id],

            ])->get();

            $scor = 0;
            foreach ($ras_date as $ras_dat) {


                if ($ras_dat->answer->corect)
                    $scor += 5;

            }


            $test['scor']=$scor;

        }

        return view('admin.indrumatori.rezultate',compact('elev','teste'));


    }
}
