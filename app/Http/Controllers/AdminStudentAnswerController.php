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
        $files = $request->file('files');
        foreach ($input['s3'] as $key => $val){

            $studentanswer = StudentAnswer::where([
                ['quiz_id', '=', $input['quiz_id']],
                ['user_id', '=', Auth::user()->id],
                ['question_id', '=', $val],

            ])->first();

            $file = $files[$val];
            $user = Auth::user();

            $name = time() . $file->getClientOriginalName();
            $string = str_replace(' ', '', $user->email); // Replaces all spaces with hyphens.
            $string = str_replace('-', '', $string); // Replaces all spaces with hyphens.
            $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string);

            $path = $name;

            if(!$studentanswer) {


                $file->move('userprojects/' . $string, $path);


                $studentanswer = new StudentAnswer;
                $studentanswer->quiz_id = $input['quiz_id'];
                $studentanswer->question_id = $val;
                $studentanswer->answer = $string.'/'.$name;//$input['rasIII'][$val];
                $studentanswer->user_id = Auth::user()->id;
                $studentanswer->save();
            }else{
                $pathE = $studentanswer->answer;

                unlink('userprojects/' . $pathE);

                $file->move('userprojects/' . $string, $path);

                $studentanswer->answer = $string.'/'.$name;//$input['rasIII'][$val];
                $studentanswer->save();
            }
        }

       // StudentAnswer::create($input);
       // return redirect('/incepe-test/'.$input['quiz_id']);
        $user=Auth::user();
        $quiz= Quiz::findOrFail($input['quiz_id']);
        $user->quizzes()->sync([$quiz->id=>['active'=>'1']]);
        return redirect('/admin');
    }

    public function ajaxsave3(Request $request){

        $quiz_id = $request->quiz_id;
        $question_id = $request->question_id;
        $subQ_id = $request->subQ_id;

        $active = Auth::user()->quizzes()->where('quiz_id', $quiz_id)->first()->pivot->active;


        $file = $request->file('file');
        $name = time() . $file->getClientOriginalName();
        $string = str_replace(' ', '', Auth::user()->email); // Replaces all spaces with hyphens.
        $string = str_replace('-', '', $string); // Replaces all spaces with hyphens.
        $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string);

        $path = $name;

        if ($active == 1) {
            $studentanswer = StudentAnswer::where([
                ['quiz_id', '=', $quiz_id],
                ['user_id', '=', Auth::user()->id],
                ['question_id', '=', $subQ_id],

            ])->first();


            $input['user_id'] = Auth::user()->id;
            $input['quiz_id'] = $quiz_id;
            $input['question_id'] = $subQ_id;
            $input['answer_id'] = 0;


            if (!$studentanswer){
                $file->move('userprojects/' . $string, $path);
                $input['answer'] = $string.'/'.$name;
                StudentAnswer::create($input);

            }

            else {
                $pathE = $studentanswer->answer;

                unlink('userprojects/' . $pathE);

                $file->move('userprojects/' . $string, $path);

                $studentanswer->answer = $string.'/'.$name;
                $studentanswer->save();
            }
            return $string.'/'.$name;
        }

        return $active;

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
