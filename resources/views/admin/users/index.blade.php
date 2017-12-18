@extends('layouts.admin')


@section('content')

    <h1>Utilizatori</h1>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nume</th>
            <th scope="col">Email</th>
            <th scope="col">Judet/Localitate</th>
            <th scope="col">Unitate de invatamant</th>
            <th scope="col">Profesor indrumator</th>
            <th scope="col">Rol</th>
            <th scope="col">Activ</th>
        </tr>
        </thead>
        <tbody>
        @if($users)
            @foreach($users as $user)
                <tr>
                    <th scope="row">{{$user->id}}</th>
                    <th scope="row">{{$user->name}}</th>
                    <th scope="row">{{$user->email}}</th>
                    <th scope="row">{{$user->judete->nume}}/{{$user->localitati->nume}}</th>
                    <th scope="row">{{$user->unitate}}</th>
                    <th scope="row">{{$user->profesor}}</th>
                    <th scope="row">{{title_case($user->role->name)}}
                    </th>
                    <th scope="row">{{($user->active==1)?'Da':'Nu'}}</th>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>

@endsection