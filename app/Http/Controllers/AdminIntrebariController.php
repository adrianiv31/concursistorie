<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Grade;
use App\Question;
use App\Section;
use Illuminate\Http\Request;

use App\Http\Requests;

class AdminIntrebariController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $intrebari = Question::all();
        return view('admin.intrebari.index', compact('intrebari'));
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
        return view('admin.intrebari.create', compact('sections', 'grades'));

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
        $nr_raspunsuri = $request->nr_raspunsuri;
        $input = $request->all();


        if ($file = $request->file('file')) {

            $name = time() . $file->getClientOriginalName();


            $file->move('images', $name);

            $input['path'] = $name;

        } else {
            $input['path'] = '';
        }

        $question = Question::create($input);

//        $request->session()->flash('intreb', 'Intrebarea a fost creata');
        return redirect(route('admin.raspunsuri.creare', [$question->id, $nr_raspunsuri]));


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
        $question = Question::findOrFail($id);
        $sections = Section::lists('name', 'id')->all();
        $grades = Grade::lists('name', 'id')->all();
        $answers = $question->answers;
        return view('admin.intrebari.edit', compact('question', 'sections', 'grades', 'answers'));
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
        $question = Question::findOrFail($id);
        $input = $request->all();


        if ($file = $request->file('file')) {

            if ($question->getOriginal('path'))
                unlink(public_path() . $question->path);

            $name = time() . $file->getClientOriginalName();


            $file->move('images', $name);

            $input['path'] = $name;

        } else {
            if (isset($input['sterge'])) {
                if ($question->getOriginal('path') && $input['sterge'] == 1) {
                    $input['path'] = '';
                    unlink(public_path() . $question->path);

                }
            } else
                $input['path'] = $question->getOriginal('path');

        }


        $question->update($input);


        return redirect(route('admin.intrebari.index'));

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
        $question = Question::findOrFail($id);


        if ($question->getOriginal('path'))
            unlink(public_path() . $question->path);

        $answers = Answer::where('question_id', '=', $question->id)->get();

        foreach ($answers as $answer) {

            if ($answer->getOriginal('path'))

                unlink(public_path() . $answer->path);
        }

        $question->delete();
        return redirect(route('admin.intrebari.index'));

    }

    public function detaliu()
    {
        $sections = Section::lists('name','id')->all();
        $grades = Grade::lists('name','id')->all();

        return view('admin.intrebari.detaliu',compact('sections','grades'));
    }
}
