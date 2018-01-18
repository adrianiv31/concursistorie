@extends('layouts.admin')


@section('content')
    <h1>Teste</h1>
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Test</th>
            <th scope="col">Secțiune</th>
            <th scope="col">Clasa</th>
            <th scope="col">Nr. intrebari</th>
            <th scope="col">Timp</th>
            <th scope="col">Activ</th>
            <th scope="col"></th>
            <th scope="col"></th>

        </tr>
        </thead>
        <tbody>
        @if($teste)
            @foreach($teste as $test)
                <tr>
                    <th scope="row">{{$test->id}}</th>
                    <td>{{$test->name}}</td>
                    <td>{{$test->section->name}}</td>
                    <td>{{$test->grade->name}}</td>
                    <td>{{$test->question_number}}</td>
                    <td>{{$test->time}}</td>
                    <td>{{$test->active}}</td>
                    <td><a href="{{route("admin.teste.edit", $test->id)}}"
                           style="text-decoration: none">
                            <img src="/img/edit.png" height="25"></a>
                    </td>
                    <td></td>
                    <td>
                        {!! Form::open(['method'=>'DELETE','action'=>['AdminTesteController@destroy',$test->id], 'onsubmit' => 'return ConfirmDialog("Sigur vreți să eliminați intrebarea?")']) !!}

                        <div class="form-group">
                            {{--{!! Form::submit('', ['style'=>'background: url("/img/delete.png") no-repeat scroll 0 0 transparent;color: #000000;cursor: pointer;font-weight: bold;height: 20px;padding-bottom: 2px;width: 75px;']) !!}--}}
                            {{--<input type="image" src="/img/delete.png" height="20" alt="Submit" />--}}
                            {!! Form::image('img/delete.png','success', array( 'height' => 25 ))  !!}
                        </div>

                        {!! Form::close() !!}


                    </td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>

@endsection
@section('footer')
    <script>

        function ConfirmDialog(message) {
            var x = confirm(message);
            if (x)
                return true;
            else
                return false;
        };

    </script>
@endsection