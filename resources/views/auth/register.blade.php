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

                            <div class="form-group{{ $errors->has('judete_id') ? ' has-error' : '' }}">
                                <label for="judete_id" class="col-md-4 control-label">Județ</label>
                                <div class="col-md-6">
                                    <select name="judete_id" id="jud">
                                        <option value="">Alegeți județul</option>
                                        @foreach($judetes as $judete)

                                            <option value="{{$judete->id}}">{{$judete->nume}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('judete_id'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('judete_id') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('localitati_id') ? ' has-error' : '' }}">
                                <label for="localitati_id" class="col-md-4 control-label">Localitate</label>
                                <div class="col-md-6">
                                    <select name="localitati_id" id="loc">
                                        <option value="">Mai întâi alegeți județul</option>

                                    </select>
                                    @if ($errors->has('localitati_id'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('localitati_id') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('unitate') ? ' has-error' : '' }}">
                                <label for="unitate" class="col-md-4 control-label">Unitatea de învățământ</label>

                                <div class="col-md-6">
                                    <input id="unitate" type="text" class="form-control" name="unitate"
                                           value="{{ old('unitate') }}">

                                    @if ($errors->has('unitate'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('unitate') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('profesor') ? ' has-error' : '' }}">
                                <label for="profesor" class="col-md-4 control-label">Profesor îndrumător</label>

                                <div class="col-md-6">
                                    <input id="profesor" type="text" class="form-control" name="profesor"
                                           value="{{ old('profesor') }}">

                                    @if ($errors->has('profesor'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('profesor') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('section_id') ? ' has-error' : '' }}">
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

                            <div class="form-group{{ $errors->has('grade_id') ? ' has-error' : '' }}">
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
        $('#jud').on('change', function (e) {
            //console.log(e);
            var judete_id = e.target.value;

            $.get('/ajax-localitatis?judete_id='+judete_id, function(data){

                $('#loc').empty();

                $.each(data, function(index, locObj){

                    $('#loc').append('<option value="'+locObj.id+'">'+locObj.nume+'</option>');

                });

            });


        });

        $('#sec').on('change', function (e) {
            //console.log(e);
            var section_id = e.target.value;

            $.get('/ajax-grades?section_id='+section_id, function(data){

                $('#gra').empty();

                $.each(data, function(index, locObj){

                    $('#gra').append('<option value="'+locObj.id+'">'+locObj.name+'</option>');

                });

            });


        });
    </script>

@endsection