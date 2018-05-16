@extends('layouts.admin')



@section('content')

    <div class="row"><h1>Creare itemi pentru întrebarea:</h1>
        <h3>{{$question->intrebare}}</h3>


        {!! Form::open(['method'=>'POST','action'=>'AdminIntrebariController@store_itemi','files'=>true]) !!}


        {!! Form::hidden('nr_itemi', $nr_itemi) !!}
        {!! Form::hidden('question_id', $question->id) !!}
    </div>

    @for($i=0;$i<$nr_itemi;$i++)
        <div class="row" style="border: 1px solid black;margin:2px;">
            <div class="col-sm-6">
                <div class="form-group">
                    {{--intrebare[] tine loc de raspuns[]--}}
                    {!! Form::label('intrebare[]','Item '.($i+1).':') !!}
                    {!! Form::text('intrebare[]', null, ['class'=>'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('file[]','Poza:') !!}
                    {!! Form::file('file[]', ['class'=>'form-control i_file']) !!}
                </div>

            </div>
            <div class="col-sm-6">
                <h1>Poza Item</h1>
                <img src="" alt="Responsive image" class="img-fluid poza" height="70">
            </div>
        </div>
    @endfor





    <div class="form-group">
        {!! Form::submit('Crează Itemi', ['class'=>'btn btn-primary']) !!}
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