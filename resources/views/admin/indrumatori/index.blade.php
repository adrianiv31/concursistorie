@extends('layouts.admin')


@section('content')

    <h1>Elevi</h1>

    <table class="table table-striped">
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
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->judete->nume}}/{{$user->localitati->nume}}</td>
                    <td>{{(!empty($user->school))?$user->school->name:""}}</td>
                    <td>{{(!empty($user->prof))?$user->prof->name:""}}</td>
                    <td> @foreach($user->roles as $role)
                            {{title_case($role->name)}}<br>
                        @endforeach
                    </td>
                    <td>{{($user->active==1)?'Da':'Nu'}}</td>
                    <td><a href="{{route("admin.indrumatori.edit", $user->id)}}" style="text-decoration: none"> <img
                                    src="/img/edit.png" height="25"></a></td>
                    <td>
                        {!! Form::open(['method'=>'DELETE','action'=>['AdminIndrumatoriController@destroy',$user->id], 'onsubmit' => 'return ConfirmDialog("Sigur vreți să eliminați utilizatorul?")']) !!}

                        <div class="form-group">
                            {{--{!! Form::submit('', ['style'=>'background: url("/img/delete.png") no-repeat scroll 0 0 transparent;color: #000000;cursor: pointer;font-weight: bold;height: 20px;padding-bottom: 2px;width: 75px;']) !!}--}}
                            {{--<input type="image" src="/img/delete.png" height="20" alt="Submit" />--}}
                            {!! Form::image('img/delete.png','success', array( 'height' => 25 ))  !!}
                        </div>

                        {!! Form::close() !!}


                    </td>
                    <td scope="row">
                        @if($user->isElev())
                            <a href="{{route("admin.intrumatori.rezultate", $user->id)}}" style="text-decoration: none">
                                Rezultate</a>
                        @endif
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