<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{ url('/') }}/favicon.ico">

    <title>

        @section('title')
            @if (isset($category))
                {{ $category->name }}
            @endif
        @show

            {{ config('app.name') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/all.css') }}" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>

</head>
<body id="page-top" class="index">

<div id="fb-root"></div>
<script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.8&appId={{ config('services.facebook.client_id') }}";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>


<script>
    var selected_category = "{{ (isset($category)) ?  $category->slug: '' }}";
</script>

<!-- Navigation -->
<nav id="mainNav" class="navbar navbar-default navbar-fixed-top navbar-custom">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header page-scroll">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
            </button>
             <a class="navbar-brand" href="{{ url('/') }}"><img class="brand" src="{{ url('/') }}/img/logo.png" alt="{{ config('app.name') }}"> </a>
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
                            <img src="{{ Auth::user()->gravatar() }}" class="user-image" alt="User Image"> {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ config('app.url') }}/home">Add Stuff!</a></li>
                            <li><a href="{{ Auth::user()->getProfileUrl() }}">Public Profile</a></li>
                            <li>
                                <a href="{{ config('app.url') }}/account/subscription">{{ (Auth::user()->subscribed('monthly')) ? 'Subscription' : 'Upgrade' }}</a></li>
                            <!-- <li><a href="{{ config('app.url') }}/saved">Saved</a></li> -->
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

@if (!Auth::check() || !Auth::user()->subscribed('monthly'))
<!-- subnav here -->
<div class=" navbar navbar-static-top subnav" role="navigation">
    <div class="navbar-inner">
        <div class="container ad-text text-center">

            <a target="_blank" href="https://www.amazon.com/gp/video/primesignup?ref_=assoc_tag_ph_1402131641212&_encoding=UTF8&camp=1789&creative=9325&linkCode=pf4&tag={{ config('services.affiliate.amazon') }}&linkId=cd36abf3f3f5a0196847fdfc25efe942"><img src="/img/amazon-prime-video.png" style="height: 25px; width: auto; padding-right: 15px;"> Watch Thousands of Movies & TV Shows Anytime! Start Your Free Trial Now!</a><img src="//ir-na.amazon-adsystem.com/e/ir?t=lessthanthrees-20&l=pf4&o=1" width="1" height="1" border="0" alt="" style="border:none !important; margin:0px !important;" /></p>
        </div>
    </div>
</div>

<!-- //subnav -->
@endif

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




                    @if (isset($selected_account))
                        <div class="col-md-12" style="padding-top: 30px;">
                            <div class="col-md-6 text-right">
                                <div class="fb-share-button" data-href="{{ urlencode(url('/')) }}" data-layout="button_count" data-size="small" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url('/')) }}">Share</a>
                                </div>
                            </div>
                            <div class="col-md-6 text-left">
                                <a class="twitter-share-button" href="https://twitter.com/intent/tweet?text={{ urlencode('Check out this list of things I love at #LessThanThrees! '.url('/')) }}"> Tweet
                                </a>
                            </div>

                        </div>
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
                        project</a>. Made with <i class="glyphicon glyphicon-heart heart"></i> by <a href="https://twitter.com/snipeyhead">@snipeyhead</a>.
                </div>
            </div>
        </div>
    </div>
</footer>

<script>window.twttr = (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0],
            t = window.twttr || {};
        if (d.getElementById(id)) return t;
        js = d.createElement(s);
        js.id = id;
        js.src = "https://platform.twitter.com/widgets.js";
        fjs.parentNode.insertBefore(js, fjs);

        t._e = [];
        t.ready = function(f) {
            t._e.push(f);
        };

        return t;
    }(document, "script", "twitter-wjs"));</script>

@section('moar_scripts')
@show

</body>
</html>
