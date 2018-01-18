@extends('layouts.admin')



@section('content')
    <div class="row">
        <div class="col-sm-6">

            <h1>Creare Intrebare</h1>
            @if (Session::has('intreb'))
                <div class="alert alert-info">{{ Session::get('intreb') }}</div>
            @endif


            {!! Form::open(['method'=>'POST','action'=>'AdminIntrebariController@store','files'=>true]) !!}
            <div class="form-group">
                {!! Form::label('intrebare','Intrebare:') !!}
                {!! Form::text('intrebare', null, ['class'=>'form-control']) !!}
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
                {!! Form::label('file','Poza:') !!}
                {!! Form::file('file', ['class'=>'form-control','id'=>'i_file']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('nr_raspunsuri','Numar de raspunsuri:') !!}
                {!! Form::number('nr_raspunsuri', 4, ['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::submit('Crează Intrebare', ['class'=>'btn btn-primary']) !!}
            </div>

            {!! Form::close() !!}


            @include('admin.includes.form_errors')
        </div>
        <div class="col-sm-6">
            <h1>Poza Intrebare</h1>
            <img src="" alt="Responsive image" class="img-fluid" id="poza">
        </div>

    </div>
@endsection

@section('scripts')

    <script>
        $('#poza').hide();
        $('#i_file').change(function (event) {
            var tmppath = URL.createObjectURL(event.target.files[0]);
            $('#poza').show(100);
            $("#poza").fadeIn("fast").attr('src', URL.createObjectURL(event.target.files[0]));

            //$("#disp_tmp_path").html("Temporary Path(Copy it and try pasting it in browser address bar) --> <strong>["+tmppath+"]</strong>");
        });
    </script>

@endsection
