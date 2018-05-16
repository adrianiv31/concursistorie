<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Question;
use Illuminate\Http\Request;

use App\Http\Requests;

class AdminRaspunsuriController extends Controller
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
    public function create($id, $nr_raspunsuri)
    {
        //

        $intrebare = Question::findOrFail($id);

        return view('admin.raspunsuri.create', compact('intrebare', 'nr_raspunsuri'));
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
        $question_id = $request->question_id;

        $nr_raspunsuri = $request->nr_raspunsuri;
        if($nr_raspunsuri == 1){
            $input[] = null;
            $input['question_id'] = $question_id;
            $input['raspuns'] = $request->raspuns;
            $input['corect'] = '1';
            $input['path'] = '';
            $answer = Answer::create($input);
            $request->session()->flash('intreb', 'Intrebarea a fost creata');
        }
        else {


            $i = 0;
            $r_corect = $request->corect;
            foreach ($request->intrebare as $intreb) {
                $input[] = null;
                $input['question_id'] = $question_id;
                $input['raspuns'] = $intreb;


                if (in_array($i, $r_corect)) {
                    $input['corect'] = '1';
                } else
                    $input['corect'] = '0';


                if ($file = $request->file[$i]) {

                    $name = md5($file->getClientOriginalName() . microtime()) . $file->getClientOriginalName();

                    $file->move('images', $name);

                    $input['path'] = $name;

                } else {
                    $input['path'] = '';
                }

                $answer = Answer::create($input);


                $i++;


            }
            $request->session()->flash('intreb', 'Intrebarea a fost creata');
        }

        return redirect(route('admin.intrebari.create'));

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

        $raspuns = Answer::findOrFail($id);

        return view('admin.raspunsuri.edit', compact('raspuns'));
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
        $raspuns = Answer::findOrFail($id);

        $input = $request->all();
        //$input['question_id']=$question_id;


        if ($request->corect) {
            $input['corect'] = '1';
        } else
            $input['corect'] = '0';


        if ($file = $request->file('file')) {

            $name = md5($file->getClientOriginalName() . microtime()) . $file->getClientOriginalName();
            if ($raspuns->getOriginal('path'))
                unlink(public_path() . $raspuns->path);

            $file->move('images', $name);

            $input['path'] = $name;

        }

        $raspuns->update($input);
        return redirect(route("admin.intrebari.edit", $raspuns->question_id));

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

        $answer = Answer::findOrFail($id);


        if ($answer->getOriginal('path'))
            unlink(public_path() . $answer->path);


        $id = $answer->question_id;
        $answer->delete();
        return redirect(route("admin.intrebari.edit", $id));
    }
}
