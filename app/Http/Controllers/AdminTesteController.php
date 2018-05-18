<?php

namespace App\Http\Controllers;

use App\Grade;
use App\Http\Requests\EvalRequest;
use App\Question;
use App\Quiz;
use App\Section;
use App\StudentAnswer;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;

class AdminTesteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $teste = Quiz::all();
        return view('admin.teste.index', compact('teste'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $sections = Section::lists('name', 'id')->all();
        $grades = Grade::lists('name', 'id')->all();

        return view('admin.teste.create', compact('sections', 'grades'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $input = $request->all();

        $test = Quiz::create($input);


        return redirect(route("admin.teste.show", $test->id));
    }

    public function storeintrebari(Request $request, $id)
    {
        $test = Quiz::findOrFail($id);
        //echo $request->selectate;exit;
        $selectate = $request->selectate;

        foreach ($selectate as $selectat) {
            $question = Question::findOrFail($selectat);
            if ($question->type != 3) {
                $pct = $request['points' . $selectat];
                $test->questions()->save($question, ['points' => $pct]);
            } else {
                $test->questions()->save($question, ['points' => '0']);
                $subquestions = $question->subQuestions;
                foreach ($subquestions as $subquestion) {
                    $pct = $request['points' . $subquestion->id];
                    $test->questions()->save($subquestion, ['points' => $pct]);
                }
            }

        }

        return redirect(route('admin.teste.index'));
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
        $test = Quiz::findOrFail($id);

        $intrebari = Question::where([

                ['section_id', '=', $test->section_id],
                ['grade_id', '=', $test->grade_id],
                ['question_id', '=', '0'],
            ]
        )->whereNOTIn('id', function ($q) {
            $q->select('question_id')->from('question_quiz');
        })->orderBy('type')->get();
        //  dd($intrebari);exit;

        return view('admin.teste.showcreate', compact('test', 'intrebari'));

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
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
        $quiz = Quiz::findOrFail($id);
        $quiz->questions()->detach();

        $quiz->delete();
        return redirect(route('admin.teste.index'));
    }

    public function corecteaza($id)
    {
        $user = User::findorFail($id);

        $quiz = $user->quizzes()->first();

        $questions = $quiz->questions;


//        foreach ($questions as $question){
//            echo $question->intrebare."<br>";
//        }
        $studentanswers = StudentAnswer::where([
            ['quiz_id', '=', $quiz->id],
            ['user_id', '=', $user->id],


        ])->get();

           return view('admin.teste.corecteaza', compact('quiz','user', 'questions', 'studentanswers'));
    }

    public function storeScore(Request $request){
        $input= $request->all();
        $studentanswers = StudentAnswer::where([
            ['quiz_id', '=', $input['quiz_id']],
            ['user_id', '=', $input['user_id']],


        ])->get();
        $score = 0;
        foreach ($studentanswers as $studentanswer){
            $score += $studentanswer->points;
        }


        return redirect(url('/teste/evalueaza'));
    }
}
