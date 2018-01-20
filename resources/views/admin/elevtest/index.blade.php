@extends('layouts.admin')


@section('content')

    <h1>Concurs</h1>
<h2 style="color:red">

    ATENTIE!!!<br>
    Intrebările vor aparea cate una pe pagina<br>
    Dupa ce ati raspuns la o intrebare si ati trecut la alta, nu veți mai putea să vă întorceți la întrebarea anterioară.<br>
    Cronometrul de pe pagină are caracter informativ. La ora 12:00 se va încheia concursul.

</h2>

    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Test</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        @if($quiz)
            @foreach($quiz as $test)
                <tr>
                    <th scope="row">{{$test->id}}</th>
                    <td>{{$test->name}}</td>
                    <td>
                        <a href="/incepe-test/{{$test->id}}">Incepe testul</a>
                    </td>

                    </td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>

@endsection
