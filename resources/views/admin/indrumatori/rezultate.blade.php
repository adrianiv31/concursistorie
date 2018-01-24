@extends('layouts.admin')


@section('content')

    <h1>Elev: {{$elev->name}}</h1>

    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Test</th>
            <th scope="col">Rezultat</th>

        </tr>
        </thead>
        <tbody>
        @if($teste)
            @foreach($teste as $test)
                <tr>
                    <th scope="row">{{$test->id}}</th>
                    <td>{{$test->name}}</td>
                    <td>{{$test->scor}}</td>

                </tr>
            @endforeach
        @endif
        </tbody>
    </table>

@endsection