@extends('layouts.test')


@section('content')


<div id="timer"></div>
 <div class="panel panel-default">
     <div class="panel-heading"><h2>{{htmlspecialchars($quest->intrebare)}}</h2>
         @if ($quest->getOriginal('path'))
         <br> <img src="{{htmlspecialchars($quest->path)}}" alt="Responsive image" class="img-fluid">;
             @endif
     </div>
     <div class="panel-body">

         {!! Form::open(['method'=>'POST','action'=>'AdminStudentAnswerController@store']) !!}

         <input type="hidden" name="quiz_id" value="{{$quiz->id}}">
         <input type="hidden" name="question_id" value="{{$quest->id}}">

         @foreach($answers as $answer)
         <div class="form-group" style="background-color: #eeeeee;margin:10px;padding: 10px;">

                 <h3>{{ Form::radio('answer_id',$answer->id) }}</h3>
             @if($answer->raspuns){{$answer->raspuns}}
            @endif
             @if ($answer->getOriginal('path'))
                 <img src="{{htmlspecialchars($answer->path)}}" alt="Responsive image" class="img-fluid">;
             @endif
             </div>

         @endforeach
             <div class="form-group">
                 {!! Form::submit('Raspunde si treci la urmatoarea intrebare', ['class'=>'btn btn-primary','id'=>'but']) !!}
             </div>

             {!! Form::close() !!}

         @if(count($errors)>0)
             <div class="alert alert-danger">

                 <ul>
                     @foreach($errors->all() as $error)
                         <li>{{$error}}</li>
                         @endforeach

                 </ul>


             </div>

             @endif

     </div>
 </div>

@endsection
@section('scripts')
    <script>
        $('#but').hide();

        $('input[name=answer_id]').on('change', function (e) {
            $('input:radio:checked').each(function() {
                $('#but').show(100);
            });
        });

        // Set the date we're counting down to
        var countDownDate = new Date("Jan 20, 2018 12:00:00").getTime();

        // Update the count down every 1 second
        var x = setInterval(function() {

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
            if(minutes<11)
            document.getElementById("timer").innerHTML = "<h5 style='color:red'>Timp ramas: " + hours + "h "
                + minutes + "m " + seconds + "s </h5>";
            else
            document.getElementById("timer").innerHTML = "<h5>Timp ramas: " + hours + "h "
                + minutes + "m " + seconds + "s </h5>";
            // If the count down is finished, write some text
            if (distance < 0) {
                clearInterval(x);
                window.location.replace('/termina-test/{{$quiz->id}}');
                //document.getElementById("timer").innerHTML = "EXpired";
            }
        }, 1000);

    </script>
    @endsection