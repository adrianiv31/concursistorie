@extends('layouts.admin')


@section('content')

    <h1>Creare Utilizator</h1>

    {!! Form::open(['method'=>'POST','action'=>'AdminUsersController@store']) !!}
    <div class="form-group">
        {!! Form::label('name','Nume:') !!}
        {!! Form::text('name', null, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('email','Email:') !!}
        {!! Form::text('email', null, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('unitate','Unitate de invatamant:') !!}
        {!! Form::text('unitate', null, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('profesor','Profesor indrumator:') !!}
        {!! Form::text('profesor', null, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::submit('Creaza Utilizator', ['class'=>'btn btn-primary']) !!}
    </div>

    {!! Form::close() !!}

@endsection