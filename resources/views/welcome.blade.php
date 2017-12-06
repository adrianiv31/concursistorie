@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Bine ați venit</div>

                <div class="panel-body">
                    @if (Auth::guest())
                        Pagina statică
                    @else

                        Sunteți autentificat ca {{ Auth::user()->name }}!

                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
