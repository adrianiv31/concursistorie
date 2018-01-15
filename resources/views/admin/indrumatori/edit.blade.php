@extends('layouts.admin')


@section('content')

    <h1>Editare Elev</h1>

    {!! Form::model($user, ['method'=>'PATCH','action'=>['AdminIndrumatoriController@update', $user->id]]) !!}
    <div class="form-group">
        {!! Form::label('name','Nume:') !!}
        {!! Form::text('name', null, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('localitati_id','Localitate:') !!}
        {!! Form::select('localitati_id',[''=>'Alegeți localitatea']+$localitatis, null, ['class'=>'form-control']) !!}
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
        {!! Form::submit('Modifică Utilizator', ['class'=>'btn btn-primary']) !!}
    </div>

    {!! Form::close() !!}


    @include('admin.includes.form_errors')



@endsection

@section('footer')
    <script>


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

    </script>

@endsection