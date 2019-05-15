@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Bine ați venit</div>

                    <div class="panel-body">
                        {{--<h1>REZULTATE</h1>--}}
                        {{--<h3>Secțiunea ARTĂ DRAMATICĂ</h3>--}}
                        {{--<img src="./images/artadramatica.png" class="img-responsive" alt="">--}}
                        {{--<br>--}}
                        {{--<h3>Secțiunea POWER POINT</h3>--}}
                        {{--<img src="./images/powerpoint.png" class="img-responsive" alt="">--}}
                        {{--<br>--}}
                        {{--<h3>Secțiunea TEORETICĂ</h3>--}}
                        {{--<h4>Clasa a V-a</h4>--}}
                        {{--<img src="./images/t5.png" class="img-responsive" alt="">--}}
                        {{--<h4>Clasa a VI-a</h4>--}}
                        {{--<img src="./images/t6.png" class="img-responsive" alt="">--}}
                        {{--<h4>Clasa a VII-a</h4>--}}
                        {{--<img src="./images/t7.png" class="img-responsive" alt="">--}}
                        {{--<h4>Clasa a VIII-a</h4>--}}
                        {{--<img src="./images/t8.png" class="img-responsive" alt="">--}}
                        @if (Auth::guest())

                            <img src="./images/balcescu.jpg" class="img-responsive" alt="">


                        @else

                            Sunteți autentificat ca {{ Auth::user()->name }}!

                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
