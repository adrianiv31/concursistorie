<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

use App\Answer;
use App\Grade;
use App\Localitati;

use App\Question;
use App\Quiz;
use App\Role;
use App\Section;
use App\StudentAnswer;
use App\User;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');

//Route::get('/register1', function(){
//
//    return view('auth.register');
//
//});


Route::group(['middleware' => 'admin'], function () {

    Route::get('admin', function () {

        return view('admin.index');

    });

    Route::group(['middleware' => 'adminadmin'], function () {


        Route::resource('admin/users', 'AdminUsersController');

        Route::get('/assignroles', function () {

            $users = User::all();
            foreach ($users as $user) {

                $user->roles()->sync([$user->role_id]);

            }

        });


        Route::resource('admin/teste', 'AdminTesteController');
        Route::get('admin/teste/creareintrebari/{id}', ['as' => 'admin.teste.creareintrebari', 'uses' => 'AdminTesteController@storeintrebari']);


    });

    Route::group(['middleware' => 'adminindrumator'], function () {


        Route::resource('admin/indrumatori', 'AdminIndrumatoriController');


    });

    Route::group(['middleware' => 'admineditor'], function () {

        Route::get('admin/intrebari/detaliu', 'AdminIntrebariController@detaliu')->name('admin.intrebari.detaliu');
        Route::resource('admin/intrebari', 'AdminIntrebariController');

        Route::resource('admin/raspunsuri', 'AdminRaspunsuriController', ['except' => ['create']]);
        Route::get('admin/raspunsuri/creare/{id}/{nr_raspunsuri}', ['as' => 'admin.raspunsuri.creare', 'uses' => 'AdminRaspunsuriController@create']);

        Route::get('/ajax-detaliu', function () {

            $section_id = Input::get('section_id');
            $grade_id = Input::get('grade_id');
            $intrebari = Question::where([

                ['section_id', '=', $section_id],
                ['grade_id', '=', $grade_id],
            ])->get();
            $html = '';
            $i = 1;
            foreach ($intrebari as $intrebare) {
                $html .= '<div class="panel panel-default">
  <div class="panel-heading"><h3>' . $i . '. ' . htmlspecialchars($intrebare->intrebare) . '</h3>';
                if ($intrebare->getOriginal('path'))
                    $html .= '<br> <img src="' . htmlspecialchars($intrebare->path) . '" alt="Responsive image" class="img-fluid">';

                $html .= '</div>
  <div class="panel-body">';

                $raspunsuri = $intrebare->answers;
                $html .= '<ol style="list-style-type: lower-alpha; font-size:20px">';
                foreach ($raspunsuri as $raspuns) {
                    if ($raspuns->corect)
                        $html .= '<li style="margin: 30px;color:#ff0000;">';
                    else
                        $html .= '<li style="margin: 30px;">';
                    if ($raspuns->raspuns)
                        $html .= htmlspecialchars($raspuns->raspuns);
                    if ($raspuns->getOriginal('path'))
                        $html .= ' <img src="' . htmlspecialchars($raspuns->path) . '" alt="Responsive image" class="img-fluid">';

                    $html .= '</li>';
                }
                $html .= '</ol>';

                $html .= '</div>
</div>';
                $i++;
            }

            return $html;
//            $section = Section::where('id', '=', $section_id)->take(1)->get();
//
//
//            if ($section[0]->name == 'Gimnaziu') $grades = Grade::where('name', '=', 'V')->get();
//            else $grades = Grade::where('name', 'like', '%X%')->get();
//
//            return Response::json($grades);

        });
    });


    /////////AJAX
    Route::get('/ajax-localitatis', function () {

        $judete_id = Input::get('judete_id');

        $localitatis = Localitati::where('judete_id', '=', $judete_id)->orderBy('nume')->get();

        return Response::json($localitatis);

    });

    Route::get('/ajax-grades', function () {

        $section_id = Input::get('section_id');

        $section = Section::where('id', '=', $section_id)->take(1)->get();


        if ($section[0]->name == 'Gimnaziu') $grades = Grade::where('name', '=', 'V')->get();
        else $grades = Grade::where('name', 'like', '%X%')->get();

        return Response::json($grades);

    });

    Route::get('/ajax-prof', function () {

        $school_id = Input::get('school_id');

        $profesori = User::whereHas('roles', function ($query) {
            $query->where('name', 'administrator')->orWhere('name', 'profesor îndrumător');
        })->where('school_id', '=', $school_id)->get();

//        $profesori = User::where([
//            ['school_id', '=', $school_id],
//            ['role_id', '=', 5],
//
//        ])->orderBy('name')->get();

        return Response::json($profesori);

    });

    Route::get('/ajax-sections', function () {


        $sectiuni = Section::all();

        return Response::json($sectiuni);

    });


});


////elev
Route::group(['middleware' => 'adminelev'], function () {

    Route::get('/elev-test', function () {

        $user = Auth::user();

        if ($user->isElev()) {
            $quiz = Quiz::where([

                ['section_id', '=', $user->section_id],
                ['grade_id', '=', $user->grade_id],
                ['active', '=', '1'],
            ])->get();

        } else if ($user->isAdmin()) {
            $quiz = Quiz::where('active', '=', '1')->get();
        }

        return view('admin.elevtest.index', compact('user', 'quiz'));


    });

    Route::get('/incepe-test/{id}', function ($id) {

        $quiz = Quiz::findOrFail($id);

        $user = Auth::user();
        $studentanswer = StudentAnswer::where([
            ['quiz_id', '=', $quiz->id],
            ['user_id', '=', $user->id],

        ])->get();

        $raspunsuri_date = [];
        $i = 0;
        foreach ($studentanswer as $raspuns) {
            $raspunsuri_date[$i] = $raspuns->question_id;
            $i++;
        }
        $questions = $quiz->questions;


        $raspunsuri_ramase = [];
        $i = 0;
        foreach ($questions as $question) {

            if (!in_array($question->id, $raspunsuri_date)) {
                $raspunsuri_ramase[$i] = $question;

                $i++;

            }
        }

        if ($i != 0 && $quiz->active == 1) {
            shuffle($raspunsuri_ramase);
            $quest = $raspunsuri_ramase[0];

            $answers = $quest->answers;


            return view('admin.elevtest.test', compact('quest', 'answers', 'quiz'));
        } else {
            $ras_date = StudentAnswer::where([
                ['quiz_id', '=', $quiz->id],
                ['user_id', '=', $user->id],

            ])->get();

            $scor = 0;
            foreach ($ras_date as $ras_dat) {


                if ($ras_dat->answer->corect)
                    $scor += 5;

            }


            return view('admin.elevtest.score', compact('scor'));
        }

    });
    Route::get('/termina-test/{id}', function ($id) {

       $quiz = Quiz::findOrFail($id);
       // $activ = ['active' => '0'];
       // $quiz->update($activ);
        return redirect('/incepe-test/' . $quiz->id);

    });
    Route::resource('admin/elevtest', 'AdminStudentAnswerController');


});

/////////////////////////AJAX
Route::get('/ajax-localitatis', function () {

    $judete_id = Input::get('judete_id');

    $localitatis = Localitati::where('judete_id', '=', $judete_id)->orderBy('nume')->get();

    return Response::json($localitatis);

});

Route::get('/ajax-grades', function () {

    $section_id = Input::get('section_id');

    $section = Section::where('id', '=', $section_id)->take(1)->get();


    if ($section[0]->name == 'Gimnaziu') $grades = Grade::where('name', '=', 'V')->get();
    else $grades = Grade::where('name', 'like', '%X%')->get();

    return Response::json($grades);

});

Route::get('/ajax-prof', function () {

    $school_id = Input::get('school_id');


    $profesori = User::whereHas('roles', function ($query) {
        $query->where('name', 'administrator')->orWhere('name', 'profesor îndrumător');
    })->where('school_id', '=', $school_id)->get();

//    $profesori = User::where([
//        ['school_id', '=', $school_id],
//        ['role_id', '=', 5],
//    ])->orderBy('name')->get();

    return Response::json($profesori);

});

Route::get('/ajax-sections', function () {


    $sectiuni = Section::all();

    return Response::json($sectiuni);

});