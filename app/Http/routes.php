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

use App\LoggedUser;
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
        //aici pentru login
        $user = Auth::user();

        $lU = $user->loggedUser;

        if(!$lU){
            $loggedUser = new LoggedUser;
            $loggedUser->user_id = $user->id;
            $loggedUser->logged = 1;
            $loggedUser->save();

        }else{

            $lU->logged = 1;
            $lU->save();
        }

        return view('admin.index');

    });

    Route::get('/logoutUser', function () {
        //aici pentru logout
        $user = Auth::user();

        $lU = $user->loggedUser;

        if(!$lU){
            $loggedUser = new LoggedUser;
            $loggedUser->user_id = $user->id;
            $loggedUser->logged = 0;
            $loggedUser->save();

        }else{

            $lU->logged = 0;
            $lU->save();
        }

        //Auth::logout();
        //return view('n.index');
        return redirect('/logout');

    });

    Route::group(['middleware' => 'adminadmin'], function () {


        Route::resource('admin/users', 'AdminUsersController');

        Route::get('/assignroles', function () {

            $users = User::all();
            foreach ($users as $user) {

                $user->roles()->sync([$user->role_id]);

            }

        });

        Route::get('admin/teste/creareintrebari/{id}', ['as' => 'admin.teste.creareintrebari', 'uses' => 'AdminTesteController@storeintrebari']);
        Route::post('admin/users/import/importUsr', ['as' => 'admin.users.importUsr', 'uses' => 'AdminUsersController@importUsr']);
        Route::get('admin/users/import/usr', 'AdminUsersController@import')->name('admin.users.import');
        Route::get('admin/users/export/usr', 'AdminUsersController@export')->name('admin.users.export');
        Route::get('admin/users/status/usr', 'AdminUsersController@status')->name('admin.users.status');
        Route::resource('admin/teste', 'AdminTesteController');
        Route::resource('admin/users', 'AdminUsersController');


    });

    Route::group(['middleware' => 'adminindrumator'], function () {


        Route::get('admin/indrumatori/rezultate/{id}', ['uses' => 'AdminIndrumatoriController@rezultate', 'as' => 'admin.intrumatori.rezultate']);

        Route::resource('admin/indrumatori', 'AdminIndrumatoriController');


    });

    Route::group(['middleware' => 'admineditor'], function () {

        Route::get('admin/intrebari/detaliu', 'AdminIntrebariController@detaliu')->name('admin.intrebari.detaliu');
        Route::get('admin/intrebari/subiectiv/{id}/{nr_itemi}', 'AdminIntrebariController@subiectiv')->name('admin.intrebari.subiectiv');
        Route::resource('admin/intrebari', 'AdminIntrebariController');

        Route::resource('admin/raspunsuri', 'AdminRaspunsuriController', ['except' => ['create']]);
        Route::get('admin/raspunsuri/creare/{id}/{nr_raspunsuri}', ['as' => 'admin.raspunsuri.creare', 'uses' => 'AdminRaspunsuriController@create']);

        Route::post('admin/intrebari/store_itemi', ['as' => 'admin.intrebari.store_itemi', 'uses' => 'AdminIntrebariController@store_itemi']);

        Route::get('/trimite-test/{id}', function ($id) {

            $quiz = Quiz::findOrFail($id);
            $grade_id = $quiz->grade->id;
            $users = User::where([
                ['grade_id', '=', $grade_id],
            ])->get();

            foreach ($users as $user) {
                $k = 0;

                $roles = $user->roles;
                foreach ($roles as $role) {
                    if ($role->id == 2) $k = 1;
                }
                if ($k == 1) {
                    $user->quizzes()->sync([$quiz->id => ['active' => '1']]);

                }

            }
            $teste = Quiz::all();
            return view('admin.teste.index', compact('teste'));

        });
        Route::get('/ajax-detaliu', function () {

            $section_id = Input::get('section_id');
            $grade_id = Input::get('grade_id');
            $intrebari = Question::where([

                ['section_id', '=', $section_id],
                ['grade_id', '=', $grade_id],
            ])->orderBy('type')->get();
            $html = '';
            $i = 1;
            foreach ($intrebari as $intrebare) {
                if ($intrebare->type != '3' && $intrebare->type != '4') {
                    $html .= '<div class="panel panel-default">
  <div class="panel-heading"><h3>' . $i . '. ' . htmlspecialchars($intrebare->intrebare) . '</h3>';
                    if ($intrebare->getOriginal('path'))
                        $html .= '<br> <img src="' . htmlspecialchars($intrebare->path) . '" alt="Responsive image" class="img-fluid">';

                    $html .= '</div>
  <div class="panel-body">';
                    $raspunsuri = $intrebare->answers;
                    if ($intrebare->type == '1') {

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
                    } else if ($intrebare->type == '2') {

                        foreach ($raspunsuri as $raspuns) {

                            if ($raspuns->raspuns)
                                $html .= '<span style="font-size:20px">' . htmlspecialchars($raspuns->raspuns) . '</span>';
                            if ($raspuns->getOriginal('path'))
                                $html .= ' <img src="' . htmlspecialchars($raspuns->path) . '" alt="Responsive image" class="img-fluid">';


                        }
                    }
                    $html .= '</div>
</div>';
                } else if ($intrebare->type == '3') {
                    $html .= '<div class="panel panel-default">
  <div class="panel-heading"><h3>' . $i . '. ' . htmlspecialchars($intrebare->intrebare) . '</h3>';
                    if ($intrebare->getOriginal('path'))
                        $html .= '<br> <img src="' . htmlspecialchars($intrebare->path) . '" alt="Responsive image" class="img-fluid">';

                    $html .= '</div>
  <div class="panel-body"><h4>Cerințe</h4>';
                    $raspunsuri = $intrebare->subQuestions;
                    $i = 1;
                    foreach ($raspunsuri as $raspuns) {

                        if ($raspuns->intrebare)
                            $html .= '<div style="font-size:20px; background-color: #eeeeee; padding: 5px;margin: 5px"><h5>Întrebarea ' . $i . '</h5>' . htmlspecialchars($raspuns->intrebare) . '</div>';
                        if ($raspuns->getOriginal('path'))
                            $html .= ' <img src="' . htmlspecialchars($raspuns->path) . '" alt="Responsive image" class="img-fluid">';
                        $i++;

                    }

                    $html .= '</div>
</div>';
                }
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
            $quiz = $user->quizzes()->wherePivot('active', 1)->get();
//            $quiz = Quiz::where([
//
//                ['section_id', '=', $user->section_id],
//                ['grade_id', '=', $user->grade_id],
//                ['active', '=', '1'],
//            ])->get();

        } else if ($user->isAdmin()) {
            $quiz = Quiz::where('active', '=', '1')->get();
        }

        return view('admin.elevtest.index', compact('user', 'quiz'));


    });
    Route::get('/ajax-save1', function () {
        $quiz_id = Input::get('quiz_id');
        $question_id = Input::get('question_id');
        $answer_id = Input::get('answer_id');

        $active = Auth::user()->quizzes()->where('quiz_id', $quiz_id)->first()->pivot->active;

        if ($active == 1) {


            $studentanswer = StudentAnswer::where([
                ['quiz_id', '=', $quiz_id],
                ['user_id', '=', Auth::user()->id],
                ['question_id', '=', $question_id],

            ])->first();


            $input['user_id'] = Auth::user()->id;
            $input['quiz_id'] = $quiz_id;
            $input['question_id'] = $question_id;
            $input['answer_id'] = $answer_id;

            if (!$studentanswer)
                StudentAnswer::create($input);
            else {
                $studentanswer->answer_id = $answer_id;
                $studentanswer->save();
            }
        }
        return $active;
    });
    Route::get('/ajax-save2', function () {
        $quiz_id = Input::get('quiz_id');
        $question_id = Input::get('question_id');
        $answer = Input::get('answer');
        $active = Auth::user()->quizzes()->where('quiz_id', $quiz_id)->first()->pivot->active;

        if ($active == 1) {
            $studentanswer = StudentAnswer::where([
                ['quiz_id', '=', $quiz_id],
                ['user_id', '=', Auth::user()->id],
                ['question_id', '=', $question_id],

            ])->first();


            $input['user_id'] = Auth::user()->id;
            $input['quiz_id'] = $quiz_id;
            $input['question_id'] = $question_id;
            $input['answer_id'] = 0;
            $input['answer'] = $answer;

            if (!$studentanswer)
                StudentAnswer::create($input);
            else {
                $studentanswer->answer = $answer;
                $studentanswer->save();
            }
        }
        return $active;
    });
    Route::get('/ajax-save3', function () {
        $quiz_id = Input::get('quiz_id');
        $question_id = Input::get('question_id');
        $subQ_id = Input::get('subQ_id');
        $answer = Input::get('answer');
        $active = Auth::user()->quizzes()->where('quiz_id', $quiz_id)->first()->pivot->active;

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
            $input['answer'] = $answer;

            if (!$studentanswer)
                StudentAnswer::create($input);
            else {
                $studentanswer->answer = $answer;
                $studentanswer->save();
            }
        }
        return $active;
    });

    Route::get('/incepe-test/{id}', function ($id) {
        $quiz = Quiz::findOrFail($id);
        $questions = $quiz->questions;
        $studentanswers = StudentAnswer::where([
            ['quiz_id', '=', $quiz->id],
            ['user_id', '=', Auth::user()->id],


        ])->get();
        $user = Auth::user();
        return view('admin.elevtest.test', compact('questions', 'quiz', 'studentanswers', 'user'));
    });
//    Route::get('/incepe-test/{id}', function ($id) {
//
//        $quiz = Quiz::findOrFail($id);
//
//        $user = Auth::user();
//        $studentanswer = StudentAnswer::where([
//            ['quiz_id', '=', $quiz->id],
//            ['user_id', '=', $user->id],
//
//        ])->get();
//
//        $raspunsuri_date = [];
//        $i = 0;
//        foreach ($studentanswer as $raspuns) {
//            $raspunsuri_date[$i] = $raspuns->question_id;
//            $i++;
//        }
//        $questions = $quiz->questions;
//
//
//        $raspunsuri_ramase = [];
//        $i = 0;
//        foreach ($questions as $question) {
//
//            if (!in_array($question->id, $raspunsuri_date)) {
//                $raspunsuri_ramase[$i] = $question;
//
//                $i++;
//
//            }
//        }
//
//        if ($i != 0 && $quiz->active == 1) {
//            shuffle($raspunsuri_ramase);
//            $quest = $raspunsuri_ramase[0];
//
//            $answers = $quest->answers;
//
//
//            return view('admin.elevtest.test', compact('quest', 'answers', 'quiz'));
//        } else {
//            $ras_date = StudentAnswer::where([
//                ['quiz_id', '=', $quiz->id],
//                ['user_id', '=', $user->id],
//
//            ])->get();
//
//            $scor = 0;
//            foreach ($ras_date as $ras_dat) {
//
//
//                if ($ras_dat->answer->corect)
//                    $scor += 5;
//
//            }
//
//
//            return view('admin.elevtest.score', compact('scor'));
//        }
//
//    });
//    Route::get('/termina-test/{id}', function ($id) {
//
//        $quiz = Quiz::findOrFail($id);
//        // $activ = ['active' => '0'];
//        // $quiz->update($activ);
//        return redirect('/incepe-test/' . $quiz->id);
//
//    });
    Route::resource('admin/elevtest', 'AdminStudentAnswerController');


});

/////////////////////////AJAX
Route::get('/ajax-localitatis', function () {

    $judete_id = Input::get('judete_id');

    $localitatis = Localitati::where('judete_id', '=', $judete_id)->orderBy('nume')->get();

    return Response::json($localitatis);

});

Route::get('/ajax-grades', function () {

//    $section_id = Input::get('section_id');
//
//    $section = Section::where('id', '=', $section_id)->take(1)->get();
//
//
//    if ($section[0]->name == 'Gimnaziu') $grades = Grade::where('name', '=', 'V')->get();
//    else $grades = Grade::where('name', 'like', '%X%')->get();
    $grades = Grade::all();
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