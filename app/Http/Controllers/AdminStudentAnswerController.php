<?php

namespace App\Http\Controllers;

use App\Http\Requests\TestRequest;
use App\Quiz;
use App\StudentAnswer;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class AdminStudentAnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TestRequest $request)
    {
        //

        $input= $request->all();
        foreach($input['s1'] as $key => $val){
            $studentanswer = StudentAnswer::where([
                ['quiz_id', '=', $input['quiz_id']],
                ['user_id', '=', Auth::user()->id],
                ['question_id', '=', $val],

            ])->first();
            if(!$studentanswer) {
                $studentanswer = new StudentAnswer;
                $studentanswer->quiz_id = $input['quiz_id'];
                $studentanswer->question_id = $val;
                $studentanswer->answer_id = $input['optradio'][$val];
                $studentanswer->user_id = Auth::user()->id;
                $studentanswer->save();
            }else{
                $studentanswer->answer_id = $input['optradio'][$val];
                $studentanswer->save();
            }

        }

        foreach ($input['s2'] as $key => $val){

            $studentanswer = StudentAnswer::where([
                ['quiz_id', '=', $input['quiz_id']],
                ['user_id', '=', Auth::user()->id],
                ['question_id', '=', $val],

            ])->first();
            if(!$studentanswer) {
                $studentanswer = new StudentAnswer;
                $studentanswer->quiz_id = $input['quiz_id'];
                $studentanswer->question_id = $val;
                $studentanswer->answer = $input['rasII'][$val];
                $studentanswer->user_id = Auth::user()->id;
                $studentanswer->save();
            }else{
                $studentanswer->answer = $input['rasII'][$val];
                $studentanswer->save();
            }
        }

        foreach ($input['s3'] as $key => $val){

            $studentanswer = StudentAnswer::where([
                ['quiz_id', '=', $input['quiz_id']],
                ['user_id', '=', Auth::user()->id],
                ['question_id', '=', $val],

            ])->first();
            if(!$studentanswer) {
                $studentanswer = new StudentAnswer;
                $studentanswer->quiz_id = $input['quiz_id'];
                $studentanswer->question_id = $val;
                $studentanswer->answer = $input['rasIII'][$val];
                $studentanswer->user_id = Auth::user()->id;
                $studentanswer->save();
            }else{
                $studentanswer->answer = $input['rasIII'][$val];
                $studentanswer->save();
            }
        }

       // StudentAnswer::create($input);
       // return redirect('/incepe-test/'.$input['quiz_id']);
        $user=Auth::user();
        $quiz= Quiz::findOrFail($input['quiz_id']);
        $user->quizzes()->sync([$quiz->id=>['active'=>'0']]);
        return redirect('/admin');
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
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
    }
}
