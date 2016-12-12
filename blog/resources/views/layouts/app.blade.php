<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ URL::asset('dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('css/app.css')}}" rel="stylesheet">
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.1/summernote.css" rel="stylesheet">
   {{--  <link href="{{ URL::asset('summernote/summernote.css')}}" rel="stylesheet"> --}}

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
            ]); ?>
    </script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-inverse navbar-static-top">
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
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Login</a></li>
                        <li><a href="{{ url('/register') }}">Register</a></li>
                        @else
                        <a href="{{ url('/friend/list') }}"><button class="btn btn-primary navbar-btn"><i class="fa fa-users" aria-hidden="true"></i> Friends</button></a>

                        <a href="{{ url('/message/list') }}"><button class="btn btn-danger navbar-btn"><i class="fa fa-envelope" aria-hidden="true"></i> Messages</button></a>


                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                <i class="fa fa-book" aria-hidden="true"></i> My Blogs  <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">    
                                @foreach (App\Blog::where('id_author', Auth::id())->orderBy('created_at', 'asc')->get() as $b)
                                <li>
                                    <a href="{{ url('/'.$b->id) }}"/>{{$b->title}}</a>
                                </li>
                                @endforeach
                            </ul>
                        </li>


                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                <i class="fa fa-file-text" aria-hidden="true"></i> Blog <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="{{ url('/blog/new') }}"/><i class="fa fa-plus" aria-hidden="true"></i> New</a>
                                </li>
                            </ul>
                        </li>

                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                <i class="fa fa-user" aria-hidden="true"></i> {{ ucfirst(Auth::user()->name) }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="{{ url('profile/'.Auth::id().'') }}"/><i class="fa fa-user-circle" aria-hidden="true"></i> Profile</a>
                                </li>
                                <li>
                                    <a href="{{ url('/logout') }}"
                                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    <i class="fa fa-sign-out" aria-hidden="true"></i> Logout
                                </a>

                                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>

                    @endif
                </ul>
            </div>
        </div>
    </nav>
    
@yield('content')
</div>

<!-- Scripts -->
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> --}}
<script src="{{ URL::asset('js/jquery.js')}}"></script>
<script src="{{ URL::asset('js/app.js')}}"></script>
{{-- <script src="{{ URL::asset('dist/js/bootstrap.min.js')}}"></script> --}}
{{-- <script src="https://use.fontawesome.com/d5b4247fd9.js"></script> --}}
<script src="{{ URL::asset('js/fontawesome.js')}}"></script>
<script src="{{ URL::asset('summernote/summernote.min.js')}}"></script>
<script>
    $(document).ready(function() {
        $('#summernote').summernote();
    });
</script>
</body>
</html>
