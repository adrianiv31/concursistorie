@extends('layouts.admin')


@section('content')

    <h1>Editare Utilizator</h1>

    {!! Form::model($user, ['method'=>'PATCH','action'=>['AdminUsersController@update', $user->id]]) !!}
    <div class="form-group">
        {!! Form::label('name','Nume:') !!}
        {!! Form::text('name', null, ['class'=>'form-control']) !!}
    </div>
    {{--<div class="form-group">--}}
        {{--{!! Form::label('email','Email:') !!}--}}
        {{--{!! Form::text('email', null, ['class'=>'form-control']) !!}--}}
    {{--</div>--}}
    <div class="form-group">
        {!! Form::label('role_id','Tip utilizator:') !!}
        {!! Form::select('role_id', [''=>'Tip utilizator']+$roles,null, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('localitati_id','Localitate:') !!}
        {!! Form::select('localitati_id',[''=>'Alegeți localitatea']+$localitatis, null, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('school_id','Unitatea de învățamânt:') !!}
        {!! Form::select('school_id',[''=>'Alegeți unitatea']+$schools, null, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group" id="pro">
        {!! Form::label('user_id','Profesor indrumator:') !!}
        {!! Form::select('user_id', [''=>'Alegeți profesorul îndrumător']+$profesori, null, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group" id="sect">
        {!! Form::label('section_id','Secțiune:') !!}
        {!! Form::select('section_id',[''=>'Alegeți secțiunea']+$sections, null, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group" id="grad">
        {!! Form::label('grade_id','Clasa:') !!}
        {!! Form::select('grade_id',[''=>'Alegți clasa']+$grades, null, ['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('password','Parola:') !!}
        {!! Form::password('password', ['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('password_confirmation','Confirmă Parola:') !!}
        {!! Form::password('password_confirmation', ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::submit('Creaza Utilizator', ['class'=>'btn btn-primary']) !!}
    </div>

    {!! Form::close() !!}


    @include('admin.includes.form_errors')



@endsection

@section('footer')
    <script>

        tip = '{{$user->role->name}}';
        if(!(tip =='elev')){
            $('#grad').hide();
            $('#sect').hide();
            $('#pro').hide();
        }
        else{



        }

        var profesor = -1;


        if($('select[name=role_id]').val()!='') {
            profesor =$('select[name=role_id]').val();


        }

        if(profesor!=-1 && profesor!=2){

            $('#grad').hide(100);
            $('#sect').hide(100);
            $('#pro').hide(100);
            $('select[name=user_id]').append('<option value="0" selected="selected"></option>');
            $('select[name=section_id]').append('<option value="0" selected="selected"></option>');
            $('select[name=grade_id]').append('<option value="0" selected="selected"></option>');

        }

        $('select[name=section_id]').on('change', function (e) {
            //console.log(e);
            var section_id = e.target.value;

            $.get('/ajax-grades?section_id=' + section_id, function (data) {

                $('select[name=grade_id]').empty();

                $.each(data, function (index, locObj) {

                    $('select[name=grade_id]').append('<option value="' + locObj.id + '">' + locObj.name + '</option>');

                });

            });


        });

        $('select[name=school_id]').on('change', function (e) {
            //console.log(e);
            if (profesor == 2) {
                var school_id = e.target.value;

                $.get('/ajax-prof?school_id=' + school_id, function (data) {

                    $('select[name=user_id]').empty();

                    $.each(data, function (index, locObj) {

                        $('select[name=user_id]').append('<option value="' + locObj.id + '">' + locObj.name + '</option>');

                    });

                });
            }


        });

        $('select[name=role_id]').on('change', function (e) {
            //console.log(e);


            var rol_id = e.target.value;

            if (rol_id == 2) {
                profesor = 2;
                $('#grad').show(100);
                $('#sect').show(100);
                $('#pro').show(100);
                $('select[name=user_id]').empty();
                $('select[name=grade_id]').empty();
                $('select[name=section_id]').empty();
                $('select[name=user_id]').append('<option value="" selected="selected">Mai întâi alegeți unitatea de învățământ</option>');

                $('select[name=grade_id]').append('<option value="" selected="selected">Mai întâi alegeți secțiunea</option>');
                $.get('/ajax-sections', function (data) {

                    $('select[name=section_id]').empty();
                    $('select[name=section_id]').append('<option value="" selected="selected">Alegeți secțiunea</option>');
                    $.each(data, function (index, locObj) {

                        $('select[name=section_id]').append('<option value="' + locObj.id + '">' + locObj.name + '</option>');

                    });

                });

            } else {
                profesor = 5;
                $('#grad').hide(100);
                $('#sect').hide(100);
                $('#pro').hide(100);
                $('select[name=user_id]').append('<option value="0" selected="selected"></option>');
                $('select[name=section_id]').append('<option value="0" selected="selected"></option>');
                $('select[name=grade_id]').append('<option value="0" selected="selected"></option>');
            }


        });

    </script>

@endsection