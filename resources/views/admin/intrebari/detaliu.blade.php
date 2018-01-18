@extends('layouts.admin')


@section('content')
    <h1>Intrebări</h1>

    <div class="row">
        <div class="col-sm-3">
            <div class="form-group">
                {!! Form::label('section_id','Sectiunea:') !!}
                {!! Form::select('section_id', [''=>'Alegeți secțiunea']+$sections,null, ['class'=>'form-control']) !!}
            </div>
        </div>
        <div class="col-sm-3">
        </div>
        <div class="col-sm-3">
            <div class="form-group">
                {!! Form::label('grade_id','Clasa:') !!}
                {!! Form::select('grade_id',[''=>'Alegeți mai întâi secțiunea'], null, ['class'=>'form-control']) !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div id="continut">

        </div>
    </div>

@endsection

@section('scripts')

    <script>
        $('select[name=section_id]').on('change', function (e) {
            //console.log(e);
            var section_id = e.target.value;

            $.get('/ajax-grades?section_id=' + section_id, function (data) {

                $('select[name=grade_id]').empty();
                $('select[name=grade_id]').append('<option value="">Alegeti clasa</option>');
                $.each(data, function (index, locObj) {

                    $('select[name=grade_id]').append('<option value="' + locObj.id + '">' + locObj.name + '</option>');

                });

            });


        });

        $('select[name=grade_id]').on('change', function (e) {
            //console.log(e);
            var section_id = $('select[name=section_id]').val();
            var grade_id = e.target.value;


            if (grade_id != '')
                $.get('/ajax-detaliu?section_id=' + section_id + "&grade_id=" + grade_id, function (data) {

                    $('#continut').html(data);
//                $('select[name=grade_id]').empty();
//
//                $.each(data, function (index, locObj) {
//
//                    $('select[name=grade_id]').append('<option value="' + locObj.id + '">' + locObj.name + '</option>');
//
//                });

                });


        });
    </script>

@endsection