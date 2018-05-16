@extends('layouts.admin')


@section('content')

    <h1>Import Utilizatori</h1>


    {!! Form::open(['method'=>'POST','action'=>'AdminUsersController@importUsr','files'=>true]) !!}

    <div class="form-group">
        {!! Form::label('file','Fișierul Excel:') !!}
        {!! Form::file('file', ['class'=>'form-control','id'=>'i_file']) !!}
    </div>
    <div class="form-group">
        {!! Form::submit('Importă', ['class'=>'btn btn-primary']) !!}
    </div>
    {!! Form::close() !!}


    @include('admin.includes.form_errors')



@endsection

@section('footer')


@endsection