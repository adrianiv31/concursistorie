@extends('layouts.admin')


@section('content')
    <h1>Intrebări</h1>
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Intrebare</th>
            <th scope="col">Secțiune</th>
            <th scope="col">Clasa</th>
            <th scope="col">Poză</th>
            <th scope="col">Editare intrebare</th>
            <th scope="col">Editare raspunsuri</th>

        </tr>
        </thead>
        <tbody>
        @if($intrebari)
            @foreach($intrebari as $intrebare)
                <tr>
                    <th scope="row">{{$intrebare->id}}</th>
                    <td>{{$intrebare->intrebare}}</td>
                    <td>{{$intrebare->section->name}}</td>
                    <td>{{$intrebare->grade->name}}</td>
                    <td>{{($intrebare->getOriginal('path'))?'Da':'Nu'}}</t>
                    <td><a href="{{route("admin.intrebari.edit", $intrebare->id)}}"
                                       style="text-decoration: none">
                            <img src="/img/edit.png" height="25"></a>
                    </td>
                    <td></td>
                    <td>
                        {!! Form::open(['method'=>'DELETE','action'=>['AdminIntrebariController@destroy',$intrebare->id], 'onsubmit' => 'return ConfirmDialog("Sigur vreți să eliminați intrebarea?")']) !!}

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