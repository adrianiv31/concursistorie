@extends('layouts.admin')



@section('content')

    <div class="row"><h1>Creare Raspunsuri</h1>


        {!! Form::open(['method'=>'POST','action'=>'AdminRaspunsuriController@store','files'=>true]) !!}


        {!! Form::hidden('nr_raspunsuri', $nr_raspunsuri) !!}
        {!! Form::hidden('question_id', $intrebare->id) !!}
    </div>
    @if($nr_raspunsuri == 1)
        <div class="form-group">
            {{--intrebare[] tine loc de raspuns[]--}}
            {!! Form::label('raspuns','Răspuns asteptat:') !!}
            {!! Form::text('raspuns', null, ['class'=>'form-control']) !!}
        </div>
    @else
        @for($i=0;$i<$nr_raspunsuri;$i++)
            <div class="row" style="border: 1px solid black;margin:2px;">
                <div class="col-sm-6">
                    <div class="form-group">
                        {{--intrebare[] tine loc de raspuns[]--}}
                        {!! Form::label('intrebare[]','Răspuns '.($i+1).':') !!}
                        {!! Form::text('intrebare[]', null, ['class'=>'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('file[]','Poza:') !!}
                        {!! Form::file('file[]', ['class'=>'form-control i_file']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('corect[]','Raspuns Corect:') !!}
                        {!! Form::checkbox('corect[]', $i, false) !!}
                    </div>
                </div>
                <div class="col-sm-6">
                    <h1>Poza Intrebare</h1>
                    <img src="" alt="Responsive image" class="img-fluid poza" height="70">
                </div>
            </div>
        @endfor
    @endif




    <div class="form-group">
        {!! Form::submit('Crează Răspunsuri', ['class'=>'btn btn-primary']) !!}
    </div>

    {!! Form::close() !!}


    @include('admin.includes.form_errors')




@endsection

@section('scripts')

    <script>
        $('.poza').hide();
        $('.i_file').change(function (event) {

            var tmppath = URL.createObjectURL(event.target.files[0]);
            $(event.target).parent().parent().parent().find('img').show(100);
            $(event.target).parent().parent().parent().find('img').fadeIn("fast").attr('src', URL.createObjectURL(event.target.files[0]));

            //$("#disp_tmp_path").html("Temporary Path(Copy it and try pasting it in browser address bar) --> <strong>["+tmppath+"]</strong>");
        });
    </script>

@endsection