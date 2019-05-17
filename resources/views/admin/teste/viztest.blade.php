@extends('layouts.test')


@section('content')
    <div class="container">
        <h2 class="text-center">CONCURS ”CĂLĂTORI PRIN ISTORIE"<br>
            FAZA NAȚIONALĂ – MAI 2019<br>


        {{--{!! Form::open(['method'=>'POST','action'=>'AdminStudentAnswerController@store','files'=>true]) !!}--}}
        <input type="hidden"
               name="quiz_id"
               value="{{$quiz->id}}"/>
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item"><a class="nav-link active" role="tab" data-toggle="tab" href="#subiectulI">Subiectul
                    I</a>
            </li>

            <li class="nav-item"><a class="nav-link" role="tab" data-toggle="tab" href="#subiectulII">Subiectul II</a>
            </li>

            <li class="nav-item"><a class="nav-link" role="tab" data-toggle="tab" href="#subiectulIII">Subiectul III</a>
            </li>

        </ul>

        <div class="tab-content">
            <div id="subiectulI" class="tab-pane active in" role="tabpanel">
                <h4 class="text-info">SUBIECTUL I <br>
                    Bifați litera corespunzătoare răspunsului corect:</h4><!--1-->

                @php
                    $i = 1;
                    $pct1 = 0;
                @endphp


                @foreach($questions as $question)
                    @if($question->type == 1)
                        <div class="well well-sm">
                            <h4 class="text-primary">{{$i}}. {{$question->intrebare}} <input type="hidden"
                                                                                             name="s1[]"
                                                                                             value="{{$question->id}}"/>
                                <span class="text-warning">{{$question->pivot->points}} puncte</span></h4>
                            <?php
                            $pct1 += $question->pivot->points;
                            $answers = $question->answers;
                            $ch = 'a';
                            // $studentanswer = $studentanswers->where('question_id', $question->id)->first()->toSql();
                            $ans = -1;
//                            foreach ($studentanswers as $studentanswer) {
//                                if ($studentanswer->question_id == $question->id)
//                                    $ans = $studentanswer->answer_id;
//                            }

                            foreach ($answers as $answer){

                            ?>

                                @if( $answer->corect == 1)
                                <label class="radio-inline text-danger">
                                    <input type="radio" name="optradio[{{$question->id}}]"
                                           value="{{$answer->id}}">{{$ch}}
                                    . {{$answer->raspuns}}
                                </label>

                                @else
                                <label class="radio-inline text-success">
                                    <input type="radio" name="optradio[{{$question->id}}]" value="{{$answer->id}}">{{$ch}}
                                    . {{$answer->raspuns}}
                                </label>
                                @endif

                            <?php
                            $ch = chr(ord($ch) + 1);
                            }
                            ?>

                        </div><!--2-->
                        @php
                            $i++;
                        @endphp

                    @endif
                @endforeach
                <div class="well well-sm">
                    <h4 class="text-primary">
                        <span class="text-warning">Total {{$pct1}} puncte</span></h4>

                </div>
            </div>

            <div id="subiectulII" class="tab-pane fade in" role="tabpanel">
                <h4 class="text-info">SUBIECTUL II <br>
                    Completați spațiile libere cu răspunsul corect:</h4>
                @php
                    $i = 1;
                    $pct2 = 0;
                @endphp
                @foreach($questions as $question)
                    @if($question->type == 2)
                        <div class="well well-sm">
                            <h4 class="text-primary">{{$i}}. {{$question->intrebare}} <input type="hidden"
                                                                                             name="s2[]"
                                                                                             value="{{$question->id}}"/>
                                <?php
                                // $studentanswer = $studentanswers->where('question_id', $question->id)->first();
                                $ans = "";
//                                foreach ($studentanswers as $studentanswer) {
//                                    if ($studentanswer->question_id == $question->id)
//                                        $ans = $studentanswer->answer;
//                                }
                                $pct2 += $question->pivot->points;
                                $answersII = $question->answers;
                                foreach ($answersII as $answerII)
                                    $ans = $answerII;
                                ?>
                                {{$question->id}}
                                    <input type="text" class="form-control" id="ii<?=$i?>"
                                           name="rasII[{{$question->id}}]"
                                           style="width:150px; display:inline" value={{$ans->raspuns}}">


                                <span class="text-warning">{{$question->pivot->points}} puncte</span></h4>
                        </div>
                        @php
                            $i++;
                        @endphp
                    @endif
                @endforeach
                <div class="well well-sm">
                    <h4 class="text-primary">
                        <span class="text-warning">Total {{$pct2}} puncte</span></h4>

                </div>
            </div>

            <div id="subiectulIII" class="tab-pane fade in" role="tabpanel">
                <h5 style="color: red">ATENȚIE!!! RĂSPUNSURILE VOR FI ÎNCĂRCATE SUB FORMĂ DE FIȘIER PDF.
                    <p>FIECARE RĂSPUNS VA FI ELABORAT ÎNTR-UN FIȘIER WORD CARE
                        VA FI SALVAT ÎN FORMAT PDF.
                    </p>
                    <p>NUMELE FIȘIERULUI VA FI FORMAT DIN CUVÂNTUL "raspuns" URMAT DE NUMĂRUL RĂSPUNSULUI ȘI EXTENSIA
                        PDF. </p>
                    <p>DE EXEMPLU, PENTRU RĂSPUNSUL NUMĂRUL 2
                        NUMELE FIȘIERULUI VA FI "raspuns2.pdf"</p></h5>
                <h4 class="text-info">SUBIECTUL III <br>
                    Citiți cu atenție textul de mai jos și răspundeți următoarelor cerințe:</h4>

                @php
                    $pct3 = 0;
                @endphp
                @foreach($questions as $question)
                    @if($question->type == 3)
                        <div class="well well-sm">
                            <p>
                                {{$question->intrebare}}
                            </p>
                        </div>
                        @php
                            $i = 1;
                        @endphp

                        <?php
                        $subQs = $question->subQuestions;

                        foreach ($subQs as $subQ){
                        $q = $quiz->questions()->findOrFail($subQ->id);
                        //$studentanswer = $studentanswers->where('question_id', $subQ->id)->first();
                        $ans = "";
//                        foreach ($studentanswers as $studentanswer) {
//                            if ($studentanswer->question_id == $subQ->id)
//                                $ans = $studentanswer->answer;
//                        }
                        $pct3 += $q->pivot->points;
                        ?>
                        <div class="well well-sm">
                            <h4 class="text-primary"><?=$i?>. {{$subQ->intrebare}} <span class="text-warning">{{$q->pivot->points}}
                                    puncte</span></h4>
                            <input type="hidden" name="s3[]"
                                   value="{{$subQ->id}}"/>

                            @if($ans!="")
                                <span id="s{{$subQ->id}}" style="visibility: visible">Răspunsul dat: <a id="a{{$subQ->id}}" href="/userprojects/{{$ans}}">Răspunsul {{$i}}</a></span>
                            @else
                                <span id="s{{$subQ->id}}" style="visibility: hidden">Răspunsul dat: <a id="a{{$subQ->id}}" href="/userprojects/{{$ans}}">Răspunsul {{$i}}</a></span>
                            @endif
                            {{--<div class="form-group">--}}
                            {{--{!! Form::label('files','Fișierul:') !!}--}}
                            {{--{!! Form::file('files['.$subQ->id.']', ['class'=>'form-control','id'=>'i_file','onchange'=>'salveaza(3,'.$quiz->id.','.$question->id.','.$subQ->id.',this)']) !!}--}}
                            {{--</div>--}}

                            {{--@if($ans!="")--}}
                            {{--<textarea class="form-control" rows="5" id="r1" name="rasIII[{{$subQ->id}}]"--}}
                            {{--onkeyup="salveaza(3,{{$quiz->id}},{{$question->id}},{{$subQ->id}},this)">{{$ans}}</textarea>--}}
                            {{--@else--}}
                            {{--<textarea class="form-control" rows="5" id="r1" name="rasIII[{{$subQ->id}}]"--}}
                            {{--onkeyup="salveaza(3,{{$quiz->id}},{{$question->id}},{{$subQ->id}},this)"></textarea>--}}
                            {{--@endif--}}
                        </div>

                        @php
                            $i++;
                        @endphp
                        <?php
                        }
                        ?>
                    @endif
                @endforeach
                <div class="well well-sm">
                    <h4 class="text-primary">
                        <span class="text-warning">Total {{$pct3}} puncte</span></h4>

                </div>
            </div>

        </div>

        {{--{!! Form::submit('Finalizează test', ['class'=>'btn btn-primary','id'=>'but']) !!}--}}
        {{--{!! Form::close() !!}--}}

    </div>

@endsection
@section('scripts')
    <script>
        //   $('#but').hide();
        //
        // $('input[name=answer_id]').on('change', function (e) {
        //     $('input:radio:checked').each(function () {
        //         $('#but').show(100);
        //     });
        // });

        // Set the date we're counting down to
        // var countDownDate = new Date("Jan 20, 2018 12:00:00").getTime();
        //
        // // Update the count down every 1 second
        // var x = setInterval(function () {
        //
        //     // Get todays date and time
        //     var now = new Date().getTime();
        //
        //     // Find the distance between now an the count down date
        //     var distance = countDownDate - now;
        //
        //     // Time calculations for days, hours, minutes and seconds
        //     var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        //     var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        //     var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        //     var seconds = Math.floor((distance % (1000 * 60)) / 1000);
        //
        //     // Display the result in the element with id="demo"
        //     if (minutes < 11)
        //         document.getElementById("timer").innerHTML = "<h5 style='color:red'>Timp ramas: " + hours + "h "
        //             + minutes + "m " + seconds + "s </h5>";
        //     else
        //         document.getElementById("timer").innerHTML = "<h5>Timp ramas: " + hours + "h "
        //             + minutes + "m " + seconds + "s </h5>";
        //     // If the count down is finished, write some text
        //     if (distance < 0) {
        //         clearInterval(x);
        //         window.location.replace('/elev-test');
        //         //document.getElementById("timer").innerHTML = "EXpired";
        //     }
        // }, 1000);

        {{--function salveaza(tip, v1, v2, v3, v4) {--}}
        {{--if (tip == 1) {--}}
        {{--quiz_id = v1;--}}
        {{--question_id = v2;--}}
        {{--answer_id = v3;--}}

        {{--$.get('/ajax-save1?quiz_id=' + quiz_id + '&question_id=' + question_id + '&answer_id=' + answer_id, function (data) {--}}
        {{--if (data == 0)--}}
        {{--window.location.replace('/elev-test');--}}
        {{--});--}}
        {{--} else if (tip == 2) {--}}
        {{--quiz_id = v1;--}}
        {{--question_id = v2;--}}
        {{--answer = v3.value;--}}
        {{--$.get('/ajax-save2?quiz_id=' + quiz_id + '&question_id=' + question_id + '&answer=' + answer, function (data) {--}}
        {{--if (data == 0)--}}
        {{--window.location.replace('/elev-test');--}}
        {{--});--}}
        {{--}--}}
        {{--else if (tip == 3) {--}}

        {{--quiz_id = v1;--}}
        {{--question_id = v2;--}}
        {{--subQ_id = v3;--}}
        {{--//                answer = v4.value;--}}
        {{--//                $.get('/ajax-save3?quiz_id=' + quiz_id + '&question_id=' + question_id + '&subQ_id=' + subQ_id + '&answer=' + answer, function (data) {--}}
        {{--//                    if (data == 0)--}}
        {{--//                        window.location.replace('/elev-test');--}}
        {{--//                });--}}

        {{--var formData = new FormData();--}}
        {{--formData.append('file', v4.files[0]);--}}
        {{--formData.append('quiz_id',quiz_id);--}}
        {{--formData.append('question_id',question_id);--}}
        {{--formData.append('subQ_id',subQ_id);--}}

        {{--$.ajax({--}}
        {{--url: "{{route('admin.elevtest.ajaxsave3')}}",--}}
        {{--type: "POST",--}}
        {{--data: formData,--}}
        {{--contentType: false,--}}
        {{--cache: false,--}}
        {{--processData: false,--}}
        {{--headers: {--}}
        {{--'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
        {{--},--}}
        {{--beforeSend: function () {--}}

        {{--},--}}
        {{--success: function (data) {--}}

        {{--//                        if (data == 'invalid') {--}}
        {{--//                            // invalid file format.--}}
        {{--//                            $("#err").html("Invalid File !").fadeIn();--}}
        {{--//                        }--}}
        {{--//                        else {--}}
        {{--//                            // view uploaded file.--}}
        {{--//                            $("#preview").html(data).fadeIn();--}}
        {{--//                            $("#form")[0].reset();--}}
        {{--//                        }--}}
        {{--$("#s"+subQ_id).attr("style", "visibility: visible");--}}
        {{--$("#a"+subQ_id).attr("href", "/userprojects/"+data);--}}
        {{--},--}}
        {{--error: function (e) {--}}
        {{--//                        $("#err").html(e).fadeIn();--}}
        {{--}--}}
        {{--});--}}

        {{--}--}}

        {{--}--}}
    </script>
@endsection