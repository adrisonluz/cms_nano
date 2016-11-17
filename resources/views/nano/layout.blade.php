<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Nano CMS</title>

        <!-- Fonts -->
        <link href="{{ url('NanoCMS/plugins/font-awesome/css/font-awesome.min.css') }}" rel='stylesheet' type='text/css'>
        <link href="{{ url('NanoCMS/css/lato.css?family=Lato:100,300,400,700') }}" rel='stylesheet' type='text/css'>

        <!-- Styles -->
        <link href="{{ url('NanoCMS/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ url('NanoCMS/plugins/summernote/summernote.css') }}" rel="stylesheet">
        <link href="{{ url('NanoCMS/plugins/select2/dist/css/select2.min.css') }}" rel="stylesheet">
        <link href="{{ url('NanoCMS/css/style.css') }}" rel="stylesheet">
        @if(isset($css))
        @foreach($css as $_css)
        <link href="{{ $_css }}" rel="stylesheet">
        @endforeach
        @endif
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
                    <a class="navbar-brand" href="{{ route('nano.cms.dashboard') }}">
                        Nano CMS
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">

                        @if (!Auth::guest())
                        <li><a href="{{ route('nano.cms.usuarios.index') }}">Usuários</a></li>
                        <li><a href="{{ route('nano.cms.paginas.index') }}">Páginas</a></li>
                        <li><a href="{{ route('nano.cms.banners.index') }}">Banners</a></li>
                        <li><a href="{{ route('nano.cms.menus.index') }}">Menus</a></li>
                        <li><a href="{{ route('nano.cms.forms.index') }}">Forms</a></li>
                        @endif

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                        <li><a href="{{ url('/cms/login') }}">Login</a></li>
                        @else


                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/cms/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                            </ul>
                        </li>
                        <li><a href="{{ url('/cms/configs') }}" alt="Configurações" title="Configurações"><i class="fa fa-btn fa-gears"></i></a></li>
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
                <strong> <a href="#">Nano CMS</a>.</strong><spam> Todos os direitos reservados.</span>
                    <div class="pull-right-md">Desenvolvido por <a href="http://adrisonluz.com" target="new" title="Entrar em contato">Adrison Luz</a></div>
            </div>
        </footer>

        <!-- JavaScripts -->
        <script src="{{ url('NanoCMS/js/jquery.min.js') }}"></script>
        <script src="{{ url('NanoCMS/js/bootstrap.min.js') }}"></script>
        <script src="{{ url('NanoCMS/js/webcam.js') }}"></script>
        <script src="{{ url('NanoCMS/plugins/input-mask/jquery.inputmask.js') }}"></script>
        <script src="{{ url('NanoCMS/plugins/input-mask/jquery.date.extensions.js') }}"></script>
        <script src="{{ url('NanoCMS/plugins/input-mask/jquery.numeric.extensions.js') }}"></script>
        <script src="{{ url('NanoCMS/plugins/input-mask/jquery.phone.extensions.js') }}"></script>
        <script src="{{ url('NanoCMS/plugins/summernote/summernote.min.js') }}"></script>
        <script src="{{ url('NanoCMS/plugins/select2/dist/js/select2.min.js') }}"></script>

        <script src="{{ url('NanoCMS/js/functions.js') }}"></script>
    @if(isset($js))
    @foreach($js as $_js)
    <script src="{{ $_js }}"></script>        
    @endforeach
    @endif
    </body>
</html>
