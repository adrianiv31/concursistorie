@extends('layouts.admin')


@section('content')

    <h1>Creare Elev</h1>

    {!! Form::open(['method'=>'POST','action'=>'AdminIndrumatoriController@store']) !!}
    <div class="form-group">
        {!! Form::label('name','Nume:') !!}
        {!! Form::text('name', null, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('email','Email:') !!}
        {!! Form::text('email', null, ['class'=>'form-control']) !!}
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
        {!! Form::select('grade_id',[''=>'Mai întâi alegeți secțiunea'], null, ['class'=>'form-control']) !!}
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

        if(!$('select[name=section_id]').val()==""){

            var section_id = $('select[name=section_id]').val();
            $.get('/ajax-grades?section_id=' + section_id, function (data) {

                $('select[name=grade_id]').empty();
                $('select[name=grade_id]').append('<option value="">Alegeți clasa</option>');
                $.each(data, function (index, locObj) {

                    $('select[name=grade_id]').append('<option value="' + locObj.id + '">' + locObj.name + '</option>');

                });

            });

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

    </script>

@endsection