<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{asset('css/app.css')}}" rel="stylesheet">

    <link href="{{asset('css/libs.css')}}" rel="stylesheet">


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    @yield('styles')

</head>

<body id="admin-page">

<div id="wrapper">

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">Acasa</a>

        </div>
        <!-- /.navbar-header -->


        {{--USER PROFILE--}}
        {{----}}
        <ul class="nav navbar-top-links navbar-right">


            <!-- /.dropdown -->
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    {{ Auth::user()->name }}
                    <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    {{--<li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>--}}
                    {{--</li>--}}
                    {{--<li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>--}}
                    {{--</li>--}}
                    <li class="divider"></li>
                    <li><a href="{{ url('/logout') }}"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                    </li>
                </ul>
                <!-- /.dropdown-user -->
            </li>
            <!-- /.dropdown -->


        </ul>


        {{--<ul class="nav navbar-nav navbar-right">--}}
        {{--@if(auth()->guest())--}}
        {{--@if(!Request::is('auth/login'))--}}
        {{--<li><a href="{{ url('/auth/login') }}">Login</a></li>--}}
        {{--@endif--}}
        {{--@if(!Request::is('auth/register'))--}}
        {{--<li><a href="{{ url('/auth/register') }}">Register</a></li>--}}
        {{--@endif--}}
        {{--@else--}}
        {{--<li class="dropdown">--}}
        {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ auth()->user()->name }} <span class="caret"></span></a>--}}
        {{--<ul class="dropdown-menu" role="menu">--}}
        {{--<li><a href="{{ url('/auth/logout') }}">Logout</a></li>--}}

        {{--<li><a href="{{ url('/admin/profile') }}/{{auth()->user()->id}}">Profile</a></li>--}}
        {{--</ul>--}}
        {{--</li>--}}
        {{--@endif--}}
        {{--</ul>--}}


        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">

                    <li>
                        <a href="/admin"><i class="fa fa-dashboard fa-fw"></i> Tablou de bord</a>
                    </li>

                    <li class="active">

                        @if(Auth::user()->isAdmin())
                            <a href="#"><i class="fa fa-wrench fa-fw"></i>
                                Utilizatori
                                <span class="fa arrow"></span></a>
                        @elseif(Auth::user()->isIndrumator())
                            <a href="#"><i class="fa fa-wrench fa-fw"></i>
                                Elevi
                                <span class="fa arrow"></span></a>
                        @endif


                        <ul class="nav nav-second-level">
                            @if(Auth::user()->isAdmin())
                                <li>
                                    <a href="{{route('admin.users.index')}}">Toti Utilizatorii</a>
                                </li>

                                <li>
                                    <a href="{{route('admin.users.create')}}">Creare Utilizator</a>
                                </li>
                                <li>
                                    <a href="{{route('admin.users.import')}}">Import Utilizatori</a>
                                </li>
                                <li>
                                    <a href="{{route('admin.users.export')}}">Export Utilizatori</a>
                                </li>
                            @elseif(Auth::user()->isIndrumator())
                                <li>
                                    <a href="{{route('admin.indrumatori.index')}}">Toti Elevii</a>
                                </li>

                                <li>
                                    <a href="{{route('admin.indrumatori.create')}}">Creare Elev</a>
                                </li>
                            @endif

                        </ul>
                        <!-- /.nav-second-level -->
                    </li>
                    @if(Auth::user()->isEditor()||Auth::user()->isAdmin())
                        <li>
                            <a href="#"><i class="fa fa-wrench fa-fw"></i>

                                Intrebări


                                <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">

                                <li>
                                    <a href="{{route('admin.intrebari.index')}}">Toate Intrebările</a>
                                </li>

                                <li>
                                    <a href="{{route('admin.intrebari.create')}}">Creare Intrebare</a>
                                </li>
                                <li>
                                    <a href="{{route('admin.intrebari.detaliu')}}">Vizualizare detaliată</a>
                                </li>

                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                    @endif
                    @if(Auth::user()->isAdmin())
                        <li>
                            <a href="#"><i class="fa fa-wrench fa-fw"></i>

                                Teste


                                <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">

                                <li>
                                    <a href="{{route('admin.teste.index')}}">Toate Testele</a>
                                </li>

                                <li>
                                    <a href="{{route('admin.teste.create')}}">Creare Test</a>
                                </li>


                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                    @endif

                    @if(Auth::user()->isAdmin()||Auth::user()->isElev())
                        <li class="active">
                            <a href="#"><i class="fa fa-wrench fa-fw"></i>

                                Teste


                                <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">

                                <li>
                                    <a href="/elev-test">Teste Active</a>
                                </li>




                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                    @endif

                </ul>


            </div>
            <!-- /.sidebar-collapse -->
        </div>
        <!-- /.navbar-static-side -->
    </nav>


</div>


<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"></h1>

                @yield('content')
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<!-- jQuery -->
<script src="{{asset('js/libs.js')}}"></script>
@yield('scripts')

@yield('footer')


</body>

</html>
