@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Înregistrare</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Nume</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name"
                                           value="{{ old('name') }}">

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">Adresă de email</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email"
                                           value="{{ old('email') }}">

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('role_id') ? ' has-error' : '' }}">
                                <label for="role_id" class="col-md-4 control-label">Tip utilizator</label>
                                <div class="col-md-6">
                                    <select name="role_id" id="rol" id="rol">
                                        <option value="" selected="selected">Alegeți tipul utilizatorului</option>
                                        @foreach($roles as $role)

                                            <option value="{{$role->id}}">{{ucfirst($role->name)}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('role_id'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('role_id') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('localitati_id') ? ' has-error' : '' }}">
                                <label for="localitati_id" class="col-md-4 control-label">Localitate</label>
                                <div class="col-md-6">
                                    <select name="localitati_id" id="loc">
                                        <option value="" selected="selected">Alegeți localitatea</option>
                                        @foreach($localitatis as $localitati)
                                            <option value="{{$localitati->id}}">{{$localitati->nume}}</option>
                                        @endforeach

                                    </select>
                                    @if ($errors->has('localitati_id'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('localitati_id') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('school_id') ? ' has-error' : '' }}" id="sch">
                                <label for="school_id" class="col-md-4 control-label">Unitatea de învățământ</label>
                                <div class="col-md-6">
                                    <select name="school_id" id="sho">
                                        <option value="">Alegeți unitatea</option>
                                        @foreach($schools as $school)

                                            <option value="{{$school->id}}">{{$school->name}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('school_id'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('school_id') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group{{ $errors->has('user_id') ? ' has-error' : '' }}" id="pro">
                                <label for="user_id" class="col-md-4 control-label">Profesor îndrumător</label>
                                <div class="col-md-6">
                                    <select name="user_id" id="prof">
                                        <option value="">Mai întâi alegeți unitatea de învățământ</option>

                                    </select>
                                    @if ($errors->has('user_id'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('user_id') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group{{ $errors->has('section_id') ? ' has-error' : '' }}" id="sect">
                                <label for="section_id" class="col-md-4 control-label">Secțiune</label>
                                <div class="col-md-6">
                                    <select name="section_id" id="sec">
                                        <option value="">Alegeți secțiunea</option>
                                        @foreach($sections as $section)

                                            <option value="{{$section->id}}">{{$section->name}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('section_id'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('section_id') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('grade_id') ? ' has-error' : '' }}" id="grad">
                                <label for="grade_id" class="col-md-4 control-label">Clasa</label>
                                <div class="col-md-6">
                                    <select name="grade_id" id="gra">
                                        <option value="">Mai întâi alegeți secțiunea</option>

                                    </select>
                                    @if ($errors->has('grade_id'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('grade_id') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-4 control-label">Parola</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password">

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                <label for="password-confirm" class="col-md-4 control-label">Confirmă Parola</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                           name="password_confirmation">

                                    @if ($errors->has('password_confirmation'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-btn fa-user"></i> Înregistrare
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('footer')
    <script>

        $('#grad').hide();
        $('#sect').hide();
        $('#pro').hide();

        var profesor = -1;

        $('#sec').on('change', function (e) {
            //console.log(e);
            var section_id = e.target.value;

            $.get('/ajax-grades?section_id=' + section_id, function (data) {

                $('#gra').empty();

                $.each(data, function (index, locObj) {

                    $('#gra').append('<option value="' + locObj.id + '">' + locObj.name + '</option>');

                });

            });


        });

        $('#sho').on('change', function (e) {
            //console.log(e);
            if(profesor == 2){
                var school_id = e.target.value;

                $.get('/ajax-prof?school_id=' + school_id, function (data) {

                    $('#prof').empty();

                    $.each(data, function (index, locObj) {

                        $('#prof').append('<option value="' + locObj.id + '">' + locObj.name + '</option>');

                    });

                });
            }



        });

        $('#rol').on('change', function (e) {
            //console.log(e);


            var rol_id = e.target.value;

            if (rol_id == 2) {
                profesor = 2;
                $('#grad').show(100);
                $('#sect').show(100);
                $('#pro').show(100);
                $('#prof').empty();
                $('#gra').empty();
                $('#sec').empty();
                $('#prof').append('<option value="" selected="selected">Mai întâi alegeți unitatea de învățământ</option>');

                $('#gra').append('<option value="" selected="selected">Mai întâi alegeți secțiunea</option>');
                $.get('/ajax-sections', function (data) {

                    $('#sec').empty();
                    $('#sec').append('<option value="" selected="selected">Alegeți secțiunea</option>');
                    $.each(data, function (index, locObj) {

                        $('#sec').append('<option value="' + locObj.id + '">' + locObj.name + '</option>');

                    });

                });

            } else {
                profesor = 5;
                $('#grad').hide(100);
                $('#sect').hide(100);
                $('#pro').hide(100);
                $('#prof').append('<option value="0" selected="selected"></option>');
                $('#sec').append('<option value="0" selected="selected"></option>');
                $('#gra').append('<option value="0" selected="selected"></option>');
            }


        });
    </script>

@endsection