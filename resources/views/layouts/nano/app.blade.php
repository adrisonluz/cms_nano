<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Nano CMS</title>

        <!-- Fonts -->
        <link href="{{ url('font-awesome/css/font-awesome.min.css') }}" rel='stylesheet' type='text/css'>
        <link href="{{ url('css/lato.css?family=Lato:100,300,400,700') }}" rel='stylesheet' type='text/css'>

        <!-- Styles -->
        <link href="{{ url('css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ url('css/style.css') }}" rel="stylesheet">

        <style>
            body {
                font-family: 'Lato';
            }

            .fa-btn {
                margin-right: 6px;
            }
        </style>
    </head>
    <body id="app-layout">
        <nav class="navbar navbar-default">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ route('dashboard') }}">
                        Nano CMS
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">

                        @if (!Auth::guest())
                        <li><a href="{{ route('usuario.index') }}">Usuários</a></li>
                        @endif

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                        <li><a href="{{ url('/admin/login') }}">Login</a></li>
                        @else


                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/admin/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                            </ul>
                        </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        <main>
            @yield('content')
        </main>

        <footer class="main-footer">
            <div class="container">
                <!-- To the right -->
                <div class="pull-right hidden-xs">
                    Desenvolvido por <a href="http://adrisonluz.com" target="new" title="Entrar em contato">Adrison Luz</a>
                </div>
                <!-- Default to the left -->
                <strong> <a href="#">Nano CMS</a>.</strong> Todos os direitos reservados.
            </div>
        </footer>

        <!-- JavaScripts -->
        <script src="{{ url('js/jquery.min.js') }}"></script>
        <script src="{{ url('js/bootstrap.min.js') }}"></script>
        <script src="{{ url('js/webcam.js') }}"></script>

        <script src="{{ url('js/functions.js') }}"></script>
    </body>
</html>
