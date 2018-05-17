@extends('layouts.admin')


@section('content')

    <h1>Utilizatori</h1>

    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nume</th>
            <th scope="col">Email</th>
            <th scope="col">Judet/Localitate</th>
            <th scope="col">Unitate de invatamant</th>
            <th scope="col">Profesor indrumator</th>
            <th scope="col">Logat</th>

        </tr>
        </thead>
        <tbody>
        @if($users)
            @foreach($users as $user)
                @if($user->roles()->where('name', 'elev')->exists())
                <tr>
                    <th scope="row">{{$user->id}}</th>
                    <th scope="row">{{$user->name}}</th>
                    <th scope="row">{{$user->email}}</th>
                    <th scope="row">{{$user->judete->nume}}/{{$user->localitati->nume}}</th>
                    <th scope="row">{{(!empty($user->school))?$user->school->name:""}}</th>
                    <th scope="row">{{(!empty($user->prof))?$user->prof->name:""}}</th>

                    <th scope="row">

                        @if($user->loggedUser && $user->loggedUser->logged == 1)
                            <span style="color: red">Autentificat</span>
                            @else
                            <span>Neautentificat</span>
                        @endif
                    </th>
                </tr>
                @endif
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