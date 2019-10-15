<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" type="image/png" href="{{ URL::asset('img/favicon.png') }}"/>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>1ID</title>

    <!-- Styles -->
    <link href="{{ URL::asset('js/alertify.js-0.3.11/themes/alertify.bootstrap.css') }}" rel="stylesheet" type="text/css" >
    <link href="{{ URL::asset('js/alertify.js-0.3.11/themes/alertify.core.css') }}" rel="stylesheet" type="text/css" >
    <link href="{{ URL::asset('js/alertify.js-0.3.11/themes/alertify.test.css') }}" rel="stylesheet" type="text/css" >
    <link href="{{ URL::asset('css/app.css') }}" rel="stylesheet" type="text/css" >
    <link href="{{ URL::asset('css/one.css') }}" rel="stylesheet" type="text/css" >
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    @if(Auth::user() && Auth::user()->isAdmin())
        <link href="{{ URL::asset('css/screen-builder.css') }}" rel="stylesheet" type="text/css" >
    @endif
    <script src="https://use.fontawesome.com/5c91db09bb.js"></script>


    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body @if(isset($class)) class="{{ $class }}" @endif>



<nav class="navbar navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ url('/') }}">
                <img height="38" src="{{ URL::asset('img/1id.jpg') }}" />
            </a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">

            <ul class="nav navbar-nav navbar-right">
                @if (Auth::check())
                    <li><a href="#">
                            <img src="{{ Auth::user()->getImage() }}" class="profile-img img-circle" />
                            {{ Auth::user()->first_name }} {{ Auth::user()->last_name }} ({{ Auth::user()->getPersonalId() }})
                        </a></li>
                    @endif
                            <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Login</a></li>
                        <li><a href="{{ url('/register') }}">Register</a></li>
                    @else
                        <li class="langs">
                            <ul>
                                <li><a href="#"><span>EN</span></a></li>
                                <li><a href="#"><span>NL</span></a></li>
                                <li><a href="#"><span>FR</span></a></li>
                            </ul>

                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="{{ route('1id.get-first-page') }}">
                                        Dashboard
                                    </a>
                                </li>
                                @if(Auth::user()->isAdmin())
                                    <li>
                                        <a href="{{ route('builder.angular.index') }}">
                                            Admin: Screen Builder
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('translator') }}">
                                            Admin: Translator
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('customize') }}">
                                            Admin: Customizing
                                        </a>
                                    </li>
                                @endif
                                <li>
                                    <a href="{{ url('/logout') }}"
                                       onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endif

            </ul>

            <!--
            <form class="navbar-form navbar-right">
                <input class="form-control" placeholder="Search..." type="text">
            </form>
            -->
        </div>
    </div>
</nav>

<div class="oneidcontainer" >
    @yield('content')
</div>

<!-- Scripts -->
<script src="{{ URL::asset('js/app.js') }}"></script>
<script src="//code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script src="{{ URL::asset('js/alertify.js-0.3.11/lib/alertify.min.js') }}"></script>
<script src="{{ URL::asset('js/1id.js') }}"></script>

{{--
<script src="{{ URL::asset('js/tinymce/tinymce.min.js') }}"></script>
<script type="text/javascript">

    tinymce.init({
        selector: 'textarea.editor',
        menu: {
            file: {title: 'File', items: 'newdocument'},
            edit: {title: 'Edit', items: 'undo redo | cut copy paste pastetext | selectall'},
            insert: {title: 'Insert', items: 'link media | template hr'},
            view: {title: 'View', items: 'visualaid'},
            format: {title: 'Format', items: 'bold italic underline | formats | removeformat'},
            table: {title: 'Table', items: 'inserttable tableprops deletetable | cell row column'},
            tools: {title: 'Tools', items: 'spellchecker code'}
        }
    });

</script>
--}}
<div id="dialogBox" class="white_content"></div>
<div id="dialogBox2" class="white_content_new"></div>
<div id="fade" class="black_overlay"></div>
</body>
</html>
