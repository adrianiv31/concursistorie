@extends('layouts.admin')



@section('content')
    <div class="row">
        <div class="col-sm-12">

            <h1>Creare Test</h1>
            @if (Session::has('intreb'))
                <div class="alert alert-info">{{ Session::get('test') }}</div>
            @endif


            {!! Form::open(['method'=>'POST','action'=>'AdminTesteController@store']) !!}
            <div class="form-group">
                {!! Form::label('name','Test:') !!}
                {!! Form::text('name', null, ['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('section_id','Sectiunea:') !!}
                {!! Form::select('section_id', [''=>'Alegeți secțiunea']+$sections,null, ['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('grade_id','Clasa:') !!}
                {!! Form::select('grade_id',[''=>'Alegeți clasa']+$grades, null, ['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('time','Timp(min):') !!}
                {!! Form::number('time', 120, ['class'=>'form-control']) !!}
            </div>
            {{--Alegere intrebari--}}



            {{--terminare alegere intrebari--}}

            <div class="form-group">
                {!! Form::submit('Crează Test', ['class'=>'btn btn-primary']) !!}
            </div>

            {!! Form::close() !!}


            @include('admin.includes.form_errors')
        </div>


    </div>
@endsection


