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

use App\Grade;
use App\Localitati;

use App\Section;
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

Route::get('/ajax-localitatis', function(){

    $judete_id = Input::get('judete_id');

    $localitatis = Localitati::where('judete_id','=',$judete_id)->orderBy('nume')->get();

    return Response::json($localitatis);

});

Route::get('/ajax-grades', function(){

    $section_id = Input::get('section_id');

    $section = Section::where('id','=',$section_id)->take(1)->get();


    if($section[0]->name == 'Gimnaziu') $grades = Grade::where('name','like','%V%')->get();
    else $grades = Grade::where('name','like','%X%')->get();

    return Response::json($grades);

});