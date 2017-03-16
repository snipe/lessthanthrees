<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" type="image/png" href="{{ url('/') }}/favicon.ico">

    <title>{{ config('app.name') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/all.css') }}" rel="stylesheet">
    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body id="page-top" class="index">

<!-- Navigation -->
<nav id="mainNav" class="navbar navbar-default navbar-fixed-top navbar-custom">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header page-scroll">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand" href="{{ url('/') }}">{{ config('app.name') }}</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                @if (isset($selected_account))
                    @foreach (\App\Category::all() as $menu_category)
                    <li><a href="{{ url('/') }}/{{ $menu_category->slug }}"><i class="{{ $menu_category->icon }}"></i> {{ $menu_category->name }}</a></li>
                    @endforeach
                @endif
                <!-- Authentication Links -->
                @if (Auth::guest())
                    <li><a href="{{ config('app.url') }}/login">Login / Register</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            <img src="{{ Auth::user() ->gravatar() }}" class="user-image" alt="User Image"> {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li><a href="https://{{ Auth::user()->username }}.{{ config('app.domain') }}">Public Profile</a></li>
                            <li>
                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                      document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
</nav>

<!-- Header -->
<header>
    <div class="container" id="maincontent" tabindex="-1">
        <div class="row">
            <div class="col-lg-12">

                @if (isset($selected_account))
                    <img class="img-responsive round-image" src="{{ $selected_account->gravatar() }}" alt="">
                @else
                    <img class="img-responsive round-image" src="{{ url('/') }}/img/lessthanthree-sm.png" alt="">
                @endif


                <div class="intro-text">
                    <h1 class="name">
                        @if (isset($selected_account))
                            {{ $selected_account->name }} &lt;3s
                        @else
                            {{ config('app.name') }}
                        @endif
                    </h1>
                    <hr class="star-light">
                    <span class="skills">

                        @if (isset($selected_account))
                            {{ $selected_account->name }}'s library of
                        @else
                            Your shareable library of
                        @endif

                        @if (isset($category))
                                <strong>{{ $category->name }}</strong>
                        @else
                            stuff
                        @endif

                        @if (isset($selected_account))
                            you'll love
                        @else
                            you love
                        @endif

                        </span>

                    @if ((Auth::check()) && (!isset($selected_account)))
                        <br><a href="{{ Auth::user()->getProfileUrl() }}" class="btn btn-lg btn-outline">View Profile
                        </a>
                    @endif

                </div>
            </div>
        </div>
    </div>
</header>
<div  id="notifications" class="container">
    <div class="row">
        @include('notifications')
    </div>
</div>
    <div id="app">
        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

<!-- Footer -->
<footer class="text-center">
    <div class="footer-below">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">

                     <a target="_blank" href="https://lessthanthrees.com">LessThanThrees</a> is an <a href="https://github.com/snipe/lessthanthrees">open source
                        project</a>. Made with <i class="fa fa-heart heart"></i> by <a href="https://twitter.com/snipeyhead">@snipeyhead</a>.
                </div>
            </div>
        </div>
    </div>
</footer>

</body>
</html>
