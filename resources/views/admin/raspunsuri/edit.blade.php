@extends('layouts.admin')



@section('content')

    <div class="row"><h1>Editare Raspunsuri</h1>


        {!! Form::model($raspuns,['method'=>'PATCH','action'=>['AdminRaspunsuriController@update',$raspuns->id],'files'=>true]) !!}




    </div>
<div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    {!! Form::label('raspuns','Răspuns:') !!}
                    {!! Form::text('raspuns', null, ['class'=>'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('file','Poza:') !!}
                    {!! Form::file('file', ['class'=>'form-control i_file']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('corect','Raspuns Corect:') !!}
                    @if($raspuns->corect==1)
                        {!! Form::checkbox('corect', 1, true) !!}
                    @else
                        {!! Form::checkbox('corect', 1, false) !!}
                    @endif

                </div>
            </div>
            <div class="col-sm-6">
                <h1>Poza Intrebare</h1>
                @if($raspuns->getOriginal('path'))
                    <img src="{{$raspuns->path}}" alt="Responsive image" class="img-fluid poza">
                @else
                    <img src="" alt="Responsive image" class="img-fluid poza" height="70">
                @endif

            </div>


</div>
    <div class="form-group">
        {!! Form::submit('Modifică Răspuns', ['class'=>'btn btn-primary']) !!}
    </div>

    {!! Form::close() !!}


    @include('admin.includes.form_errors')




@endsection

@section('scripts')

    <script>
       // $('.poza').hide();
        $('.i_file').change(function (event) {

            var tmppath = URL.createObjectURL(event.target.files[0]);
            $(event.target).parent().parent().parent().find('img').show(100);
            $(event.target).parent().parent().parent().find('img').fadeIn("fast").attr('src', URL.createObjectURL(event.target.files[0]));

            //$("#disp_tmp_path").html("Temporary Path(Copy it and try pasting it in browser address bar) --> <strong>["+tmppath+"]</strong>");
        });
    </script>

@endsection