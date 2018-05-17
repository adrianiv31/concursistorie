@extends('layouts.test')


@section('content')
    <div class="container">
        <h2 class="text-center">CONCURS ”CĂLĂTORI PRIN ISTORIE"<br>
            FAZA NAȚIONALĂ – MAI 2018<br>
            CLASA a {{$user->grade->name}}-a</h2>
        @include('admin.includes.form_test_errors')

        {!! Form::open(['method'=>'POST','action'=>'AdminStudentAnswerController@store']) !!}
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


                {{--*/$i = 1/*--}}
                {{--*/$pct1 = 0/*--}}
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
                            foreach ($studentanswers as $studentanswer) {
                                if($studentanswer->question_id == $question->id)
                                    $ans = $studentanswer->answer_id;
                            }

                            foreach ($answers as $answer){

                            ?>
                            <label class="radio-inline text-success">
                                @if($ans == $answer->id)
                                    <input checked="checked" type="radio" name="optradio[{{$question->id}}]"
                                           value="{{$answer->id}}"
                                           onchange="salveaza(1,{{$quiz->id}},{{$question->id}},{{$answer->id}})">{{$ch}}
                                    . {{$answer->raspuns}}


                                @else

                                    <input type="radio" name="optradio[{{$question->id}}]" value="{{$answer->id}}"
                                           onchange="salveaza(1,{{$quiz->id}},{{$question->id}},{{$answer->id}})">{{$ch}}
                                    . {{$answer->raspuns}}
                                @endif
                            </label>
                            <?php
                            $ch = chr(ord($ch) + 1);
                            }
                            ?>

                        </div><!--2-->

                        {{--*/$i++/*--}}
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
                {{--*/$i = 1/*--}}
                {{--*/$pct2 = 0/*--}}
                @foreach($questions as $question)
                    @if($question->type == 2)
                        <div class="well well-sm">
                            <h4 class="text-primary">{{$i}}. {{$question->intrebare}} <input type="hidden"
                                                                                             name="s2[]"
                                                                                             value="{{$question->id}}"/>
                                <?php
                               // $studentanswer = $studentanswers->where('question_id', $question->id)->first();
                                $ans = "";
                                foreach ($studentanswers as $studentanswer) {
                                    if($studentanswer->question_id == $question->id)
                                        $ans = $studentanswer->answer;
                                }
                                $pct2 += $question->pivot->points;
                                ?>
                                @if($ans != "")
                                    <input type="text" class="form-control" id="ii<?=$i?>"
                                           name="rasII[{{$question->id}}]"
                                           style="width:150px; display:inline" value="{{$ans}}"
                                           onkeyup="salveaza(2,{{$quiz->id}},{{$question->id}},this)">

                                @else
                                    <input type="text" class="form-control" id="ii<?=$i?>"
                                           name="rasII[{{$question->id}}]"
                                           style="width:150px; display:inline" value=""
                                           onkeyup="salveaza(2,{{$quiz->id}},{{$question->id}},this)">
                                @endif
                                <span class="text-warning">{{$question->pivot->points}} puncte</span></h4>
                        </div>
                        {{--*/$i++/*--}}
                    @endif
                @endforeach
                <div class="well well-sm">
                    <h4 class="text-primary">
                        <span class="text-warning">Total {{$pct2}} puncte</span></h4>

                </div>
            </div>

            <div id="subiectulIII" class="tab-pane fade in" role="tabpanel">
                <h4 class="text-info">SUBIECTUL III <br>
                    Citiți cu atenție textul de mai jos și răspundeți următoarelor cerințe:</h4>
                {{--*/$pct3 = 0/*--}}
                @foreach($questions as $question)
                    @if($question->type == 3)
                        <div class="well well-sm">
                            <p>
                                {{$question->intrebare}}
                            </p>
                        </div>

                        {{--*/$i = 1/*--}}
                        <?php
                        $subQs = $question->subQuestions;

                        foreach ($subQs as $subQ){
                        $q = $quiz->questions()->findOrFail($subQ->id);
                        //$studentanswer = $studentanswers->where('question_id', $subQ->id)->first();
                        $ans = "";
                        foreach ($studentanswers as $studentanswer) {
                            if($studentanswer->question_id == $subQ->id)
                                $ans = $studentanswer->answer;
                        }
                        $pct3 += $q->pivot->points;
                        ?>
                        <div class="well well-sm">
                            <h4 class="text-primary"><?=$i?>. {{$subQ->intrebare}} <span class="text-warning">{{$q->pivot->points}}
                                    puncte</span></h4>
                            <input type="hidden" name="s3[]"
                                   value="{{$subQ->id}}"/>
                            @if($ans!="")
                                <textarea class="form-control" rows="5" id="r1" name="rasIII[{{$subQ->id}}]"
                                          onkeyup="salveaza(3,{{$quiz->id}},{{$question->id}},{{$subQ->id}},this)">{{$ans}}</textarea>
                            @else
                                <textarea class="form-control" rows="5" id="r1" name="rasIII[{{$subQ->id}}]"
                                          onkeyup="salveaza(3,{{$quiz->id}},{{$question->id}},{{$subQ->id}},this)"></textarea>
                            @endif
                        </div>

                        {{--*/$i++/*--}}
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
        {!! Form::submit('Finalizează test', ['class'=>'btn btn-primary','id'=>'but']) !!}
        {!! Form::close() !!}

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
        var countDownDate = new Date("Jan 20, 2018 12:00:00").getTime();

        // Update the count down every 1 second
        var x = setInterval(function () {

            // Get todays date and time
            var now = new Date().getTime();

            // Find the distance between now an the count down date
            var distance = countDownDate - now;

            // Time calculations for days, hours, minutes and seconds
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Display the result in the element with id="demo"
            if (minutes < 11)
                document.getElementById("timer").innerHTML = "<h5 style='color:red'>Timp ramas: " + hours + "h "
                    + minutes + "m " + seconds + "s </h5>";
            else
                document.getElementById("timer").innerHTML = "<h5>Timp ramas: " + hours + "h "
                    + minutes + "m " + seconds + "s </h5>";
            // If the count down is finished, write some text
            if (distance < 0) {
                clearInterval(x);
                window.location.replace('/elev-test');
                //document.getElementById("timer").innerHTML = "EXpired";
            }
        }, 1000);

        function salveaza(tip, v1, v2, v3, v4) {
            if (tip == 1) {
                quiz_id = v1;
                question_id = v2;
                answer_id = v3;

                $.get('/ajax-save1?quiz_id=' + quiz_id + '&question_id=' + question_id + '&answer_id=' + answer_id, function (data) {

                });
            } else if (tip == 2) {
                quiz_id = v1;
                question_id = v2;
                answer = v3.value;
                $.get('/ajax-save2?quiz_id=' + quiz_id + '&question_id=' + question_id + '&answer=' + answer, function (data) {

                });
            }
            else if (tip == 3) {
                quiz_id = v1;
                question_id = v2;
                subQ_id = v3;
                answer = v4.value;
                $.get('/ajax-save3?quiz_id=' + quiz_id + '&question_id=' + question_id + '&subQ_id=' + subQ_id + '&answer=' + answer, function (data) {

                });
            }

        }
    </script>
@endsection