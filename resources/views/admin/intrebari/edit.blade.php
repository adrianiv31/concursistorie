@extends('layouts.admin')



@section('content')


    <div class="row">
        <div class="col-sm-6">

            <h1>Editare Intrebare</h1>

            {!! Form::model($question,['method'=>'PATCH','action'=>['AdminIntrebariController@update',$question->id],'files'=>true]) !!}
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
                {!! Form::submit('Modifica Intrebare', ['class'=>'btn btn-primary']) !!}
            </div>


            @include('admin.includes.form_errors')

        </div>
        <div class="form-group">
            {!! Form::label('sterge','Stergeti poza:') !!}
            {!! Form::checkbox('sterge', 1,false) !!}
        </div>
        <div class="col-sm-6">
            <h1>Poza Intrebare</h1>
            <img src="{{$question->path}}" alt="Responsive image" class="img-fluid" id="poza">
        </div>

        {!! Form::close() !!}
    </div>
    <div class="row">

        <p>
            {{$question->intrebare}}
        </p>
        <p>
            @if($question->getOriginal('path'))
                <img src="{{$question->path}}" alt="Responsive image" class="img-fluid">
            @endif
        </p>
        <div class="col-sm-12">
            <ol type="a">
                @foreach($answers as $answer)

                    <li style="border: 1px solid black;margin:2px;">@if($answer->raspuns)
                            {{$answer->raspuns}}
                        @endif
                        <p>
                            @if($answer->getOriginal('path'))
                                <img src="{{$answer->path}}" alt="Responsive image" class="img-fluid">
                            @endif
                                <a href="{{route("admin.raspunsuri.edit", $answer->id)}}" style="text-decoration: none">
                                    <img src="/img/edit.png" height="25"></a>
                        {!! Form::open(['method'=>'DELETE','action'=>['AdminRaspunsuriController@destroy',$answer->id], 'onsubmit' => 'return ConfirmDialog("Sigur vreți să eliminați intrebarea?")']) !!}

                        <div class="form-group">
                            {{--{!! Form::submit('', ['style'=>'background: url("/img/delete.png") no-repeat scroll 0 0 transparent;color: #000000;cursor: pointer;font-weight: bold;height: 20px;padding-bottom: 2px;width: 75px;']) !!}--}}
                            {{--<input type="image" src="/img/delete.png" height="20" alt="Submit" />--}}
                            {!! Form::image('img/delete.png','success', array( 'height' => 25 ))  !!}
                        </div>

                        {!! Form::close() !!}
                        </p>
                        @if($answer->corect==1)
                             <b>CORECT</b>
                            @endif

                    </li>




                @endforeach
            </ol>

            {{--{!! Form::open(['method'=>'OST','action'=>'PostsController@create']) !!}--}}
                {{--<div class="form-group">--}}
                    {{--{!! Form::label('title','TItle:') !!}--}}
                    {{--{!! Form::text('title', null, ['class'=>'form-control']) !!}--}}
                {{--</div>--}}
                {{--<div class="form-group">--}}
                    {{--{!! Form::submit('Create Post', ['class'=>'btn btn-primary']) !!}--}}
                {{--</div>--}}

                {{--{!! Form::close() !!}--}}
        </div>

    </div>
@endsection
@section('scripts')

    <script>

        @if($question->path==null)
$('#poza').hide();
        @endif

$('#i_file').change(function (event) {

            var tmppath = URL.createObjectURL(event.target.files[0]);
            //    $('#poza').show(100);
            $("#poza").fadeIn("fast").attr('src', URL.createObjectURL(event.target.files[0]));

            //$("#disp_tmp_path").html("Temporary Path(Copy it and try pasting it in browser address bar) --> <strong>["+tmppath+"]</strong>");
        });
    </script>

@endsection

