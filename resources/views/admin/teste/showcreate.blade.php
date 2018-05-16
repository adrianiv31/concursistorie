@extends('layouts.admin')



@section('content')
    <div class="row">
        <div class="col-sm-12">

            <h1>Adaugare intrebari pentru {{$test->name}}</h1>
            @if (Session::has('intreb'))
                <div class="alert alert-info">{{ Session::get('test') }}</div>
            @endif


            {!! Form::open(['method'=>'GET','action'=>['AdminTesteController@storeintrebari',$test->id]]) !!}


            @if($intrebari)
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#obiectivi">Itemi Obiectivi</a></li>
                    <li><a data-toggle="tab" href="#semiobiectivi">Itemi Semiobiectivi</a></li>
                    <li><a data-toggle="tab" href="#subiectivi">Itemi Subiectivi</a></li>
                </ul>

                <div class="tab-content">
                    <div id="obiectivi" class="tab-pane fade in active">
                        <h3>Itemi Obiectivi</h3>
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Intrebare</th>

                                <th class="col">Punctaj

                                    <div class="form-group">

                                        {!! Form::number('pct1_all', 2, false) !!}
                                    </div>
                                </th>
                                <th scope="col">Poza</th>
                                <th scope="col">

                                    {!! Form::checkbox('select_all', 'sel', false) !!}
                                </th>


                            </tr>
                            </thead>
                            <tbody>
                            {{--*/ $i = 0 /*--}}
                            @foreach($intrebari as $intrebare)
                                @if($intrebare->type == 1)
                                    <tr>
                                        <th scope="row">{{$intrebare->id}} - {{$i+1}}</th>
                                        <td>{{$intrebare->intrebare}}</td>

                                        <td>
                                            <div class="form-group">

                                                {!! Form::number('points'.+$intrebare->id, 2,['class'=>'pct1']) !!}
                                            </div>
                                        </td>
                                        <td> @if($intrebare->getOriginal('path'))
                                                <img src="{{$intrebare->path}}" alt="Responsive image" class="img-fluid"
                                                     height="50">
                                            @else
                                                Nu are
                                            @endif
                                        </td>
                                        <td>
                                            <div class="form-group">

                                                {!! Form::checkbox('selectate[]', $intrebare->id, false,['class'=>'intreb']) !!}
                                            </div>
                                        </td>


                                    </tr>
                                    <tr>
                                        <td colspan="6">
                                            <?php
                                            $raspunsuri = $intrebare->answers;
                                            //dd($raspunsuri);exit;
                                            echo '<ul>';
                                            foreach ($raspunsuri as $raspuns) {
                                                if ($raspuns->corect == 1)
                                                    echo '<li style="color:red">' . $raspuns->raspuns . '</li>';
                                                else
                                                    echo '<li>' . $raspuns->raspuns . '</li>';
                                            }
                                            echo '</ul>'
                                            ?>

                                        </td>
                                    </tr>
                                    {{--*/ $i++ /*--}}
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div id="semiobiectivi" class="tab-pane fade">
                        <h3>Itemi Obiectivi</h3>
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Intrebare</th>
                                <th class="col">Tip Item</th>
                                <th class="col">Punctaj

                                    <div class="form-group">

                                        {!! Form::number('pct2_all', 4, false) !!}
                                    </div>
                                </th>
                                <th scope="col">Poza</th>
                                <th scope="col">

                                    {!! Form::checkbox('select_all', 'sel', false) !!}
                                </th>


                            </tr>
                            </thead>
                            <tbody>
                            {{--*/ $i = 0 /*--}}
                            @foreach($intrebari as $intrebare)
                                @if($intrebare->type == 2)
                                    <tr>
                                        <th scope="row">{{$intrebare->id}} - {{$i+1}}</th>
                                        <td>{{$intrebare->intrebare}}</td>
                                        <td>
                                            @if($intrebare->type == 1) Obiectiv
                                            @elseif($intrebare->type == 2) Semiobiectiv
                                            @else Subiectiv
                                            @endif
                                        </td>
                                        <td>
                                            <div class="form-group">

                                                {!! Form::number('points'.+$intrebare->id, 4,['class'=>'pct2']) !!}
                                            </div>
                                        </td>
                                        <td> @if($intrebare->getOriginal('path'))
                                                <img src="{{$intrebare->path}}" alt="Responsive image" class="img-fluid"
                                                     height="50">
                                            @else
                                                Nu are
                                            @endif
                                        </td>
                                        <td>
                                            <div class="form-group">

                                                {!! Form::checkbox('selectate[]', $intrebare->id, false,['class'=>'intreb']) !!}
                                            </div>
                                        </td>


                                    </tr>
                                    <tr>
                                        <td colspan="6">
                                            <?php
                                            $raspunsuri = $intrebare->answers;
                                            //dd($raspunsuri);exit;
                                            echo '<ul>';
                                            foreach ($raspunsuri as $raspuns) {

                                                echo '<li style="color:red">' . $raspuns->raspuns . '</li>';

                                            }
                                            echo '</ul>'
                                            ?>

                                        </td>
                                    </tr>
                                    {{--*/ $i++ /*--}}
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div id="subiectivi" class="tab-pane fade">
                        <h3>Itemi Obiectivi</h3>
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Intrebare</th>
                                <th class="col">Punctaj</th>
                                <th scope="col">Poza</th>
                                <th scope="col">

                                    {!! Form::checkbox('select_all', 'sel', false) !!}
                                </th>


                            </tr>
                            </thead>
                            <tbody>
                            {{--*/ $i = 0 /*--}}
                            @foreach($intrebari as $intrebare)
                                @if($intrebare->type == 3)
                                    <tr>
                                        <th scope="row">{{$intrebare->id}} - {{$i+1}}</th>
                                        <td>{{$intrebare->intrebare}}</td>
                                        <td>

                                        </td>
                                        <td> @if($intrebare->getOriginal('path'))
                                                <img src="{{$intrebare->path}}" alt="Responsive image" class="img-fluid"
                                                     height="50">
                                            @else
                                                Nu are
                                            @endif
                                        </td>
                                        <td>
                                            <div class="form-group">

                                                {!! Form::checkbox('selectate[]', $intrebare->id, false,['class'=>'intreb']) !!}
                                            </div>
                                        </td>


                                    </tr>

                                    <?php
                                    $subintrebari = $intrebare->subQuestions;
                                    //dd($raspunsuri);exit;

                                    foreach ($subintrebari as $subintrebare) {
                                    ?>
                                    <tr>
                                        <td colspan="2">
                                            <?php

                                            echo $subintrebare->intrebare;
                                            ?>

                                        </td>
                                        <td>
                                            <div class="form-group">

                                                {!! Form::number('points'.+$subintrebare->id, null,['class'=>'pct3']) !!}
                                            </div>
                                        </td>
                                        <td> @if($subintrebare->getOriginal('path'))
                                                <img src="{{$subintrebare->path}}" alt="Responsive image" class="img-fluid"
                                                     height="50">
                                            @else
                                                Nu are
                                            @endif
                                        </td>
                                        <td></td>
                                    </tr>
                                    <?php

                                    }

                                    ?>


                                    {{--*/ $i++ /*--}}
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>


            @endif


            {{--<div class="form-group">--}}
            {{--{!! Form::label('name','Test:') !!}--}}
            {{--{!! Form::text('name', null, ['class'=>'form-control']) !!}--}}
            {{--</div>--}}

            {{--<div class="form-group">--}}
            {{--{!! Form::label('section_id','Sectiunea:') !!}--}}
            {{--{!! Form::select('section_id', [''=>'Alegeți secțiunea']+$sections,null, ['class'=>'form-control']) !!}--}}
            {{--</div>--}}

            {{--<div class="form-group">--}}
            {{--{!! Form::label('grade_id','Clasa:') !!}--}}
            {{--{!! Form::select('grade_id',[''=>'Alegeți clasa']+$grades, null, ['class'=>'form-control']) !!}--}}
            {{--</div>--}}

            {{--<div class="form-group">--}}
            {{--{!! Form::label('time','Timp(min):') !!}--}}
            {{--{!! Form::number('time', 120, ['class'=>'form-control']) !!}--}}
            {{--</div>--}}
            {{--Alegere intrebari--}}



            {{--terminare alegere intrebari--}}

            <div class="form-group">
                {!! Form::submit('Adauga Intrebari', ['class'=>'btn btn-primary']) !!}
            </div>

            {!! Form::close() !!}


            @include('admin.includes.form_errors')
        </div>


    </div>
@endsection

@section('scripts')

    <script>

        $('input[name=select_all]').on('change', function (e) {
            if ($('input[name=select_all]').is(":checked")) {
                $('.intreb').each(function (i) {
                    this.checked = 1;
                });

            }
            else {
                $('.intreb').each(function (i) {
                    this.checked = 0;
                });
            }
        });

        $('input[name=pct1_all]').on('keyup', function (e) {

            $('.pct1').each(function (i) {

                this.value = e.target.value;
            });
        });

        $('input[name=pct2_all]').on('keyup', function (e) {

            $('.pct2').each(function (i) {

                this.value = e.target.value;
            });
        });
        //        $('#i_file').change(function (event) {
        //            var tmppath = URL.createObjectURL(event.target.files[0]);
        //            $('#poza').show(100);
        //            $("#poza").fadeIn("fast").attr('src', URL.createObjectURL(event.target.files[0]));
        //
        //            //$("#disp_tmp_path").html("Temporary Path(Copy it and try pasting it in browser address bar) --> <strong>["+tmppath+"]</strong>");
        //        });
    </script>

@endsection
