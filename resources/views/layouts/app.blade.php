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

        @if (Auth::check())
            {{ Auth::user()->name }}
        @endif

        {{ config('app.name') }}

        @section('title')
            @if (isset($category))
                {{ $category->name }}
            @endif
        @show

    </title>

    <!-- Styles -->
    <link href="{{ asset('/css/all.css') }}" rel="stylesheet">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

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
<div id="navtop">
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
                    @foreach (\App\Category::whereNull('parent_id')->get() as $menu_category)
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
                            <li><a href="{{ config('app.url') }}/account/edit" }}">Edit Profile</a></li>
                            <li><a href="{{ config('app.url') }}/account/password" }}">Update Password</a></li>
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
</div>

@if (!Auth::check() || !Auth::user()->subscribed('monthly'))
@include('layouts/top-ad')
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
                            <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                                <div class="fb-share-button" data-href="{{ urlencode(url('/')) }}" data-layout="button_count" data-size="small" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url('/')) }}">Share</a>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6  col-xs-6  text-left">
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



<!-- Footer -->
<footer>
    <div class="footer-below">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-xs-12">
                    <a href="{{ config('app.url') }}/privacy">Privacy</a> | <a href="https://github.com/snipe/lessthanthrees">Open Source</a> |
                     Made with <i class="glyphicon glyphicon-heart heart"></i> by <a href="https://twitter.com/snipeyhead">@snipeyhead</a>.
                    Follow <a href="https://twitter.com/lessthan3sapp">@lessthan3sapp</a> for updates.
                </div>
                <div class="col-lg-4 col-xs-12 text-right">
                     <a href="{{ config('app.url') }}"><img src="{{ url('/') }}/img/logo.png" alt="{{ config('app.name') }}" style="height: 15px;"></a>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>

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

@if (config('services.rollbar.client_access_token'))
    <script>
        var _rollbarConfig = {
            accessToken: "{{ config('services.rollbar.client_access_token') }}",
            captureUncaught: true,
            captureUnhandledRejections: true,
            payload: {
                environment: "{{ App::environment() }}"
            }
        };
        // Rollbar Snippet
        !function(r){function e(n){if(o[n])return o[n].exports;var t=o[n]={exports:{},id:n,loaded:!1};return r[n].call(t.exports,t,t.exports,e),t.loaded=!0,t.exports}var o={};return e.m=r,e.c=o,e.p="",e(0)}([function(r,e,o){"use strict";var n=o(1).Rollbar,t=o(2);_rollbarConfig.rollbarJsUrl=_rollbarConfig.rollbarJsUrl||"https://cdnjs.cloudflare.com/ajax/libs/rollbar.js/1.9.3/rollbar.min.js";var a=n.init(window,_rollbarConfig),i=t(a,_rollbarConfig);a.loadFull(window,document,!_rollbarConfig.async,_rollbarConfig,i)},function(r,e){"use strict";function o(r){return function(){try{return r.apply(this,arguments)}catch(r){try{console.error("[Rollbar]: Internal error",r)}catch(r){}}}}function n(r,e,o){window._rollbarWrappedError&&(o[4]||(o[4]=window._rollbarWrappedError),o[5]||(o[5]=window._rollbarWrappedError._rollbarContext),window._rollbarWrappedError=null),r.uncaughtError.apply(r,o),e&&e.apply(window,o)}function t(r){var e=function(){var e=Array.prototype.slice.call(arguments,0);n(r,r._rollbarOldOnError,e)};return e.belongsToShim=!0,e}function a(r){this.shimId=++c,this.notifier=null,this.parentShim=r,this._rollbarOldOnError=null}function i(r){var e=a;return o(function(){if(this.notifier)return this.notifier[r].apply(this.notifier,arguments);var o=this,n="scope"===r;n&&(o=new e(this));var t=Array.prototype.slice.call(arguments,0),a={shim:o,method:r,args:t,ts:new Date};return window._rollbarShimQueue.push(a),n?o:void 0})}function l(r,e){if(e.hasOwnProperty&&e.hasOwnProperty("addEventListener")){var o=e.addEventListener;e.addEventListener=function(e,n,t){o.call(this,e,r.wrap(n),t)};var n=e.removeEventListener;e.removeEventListener=function(r,e,o){n.call(this,r,e&&e._wrapped?e._wrapped:e,o)}}}var c=0;a.init=function(r,e){var n=e.globalAlias||"Rollbar";if("object"==typeof r[n])return r[n];r._rollbarShimQueue=[],r._rollbarWrappedError=null,e=e||{};var i=new a;return o(function(){if(i.configure(e),e.captureUncaught){i._rollbarOldOnError=r.onerror,r.onerror=t(i);var o,a,c="EventTarget,Window,Node,ApplicationCache,AudioTrackList,ChannelMergerNode,CryptoOperation,EventSource,FileReader,HTMLUnknownElement,IDBDatabase,IDBRequest,IDBTransaction,KeyOperation,MediaController,MessagePort,ModalWindow,Notification,SVGElementInstance,Screen,TextTrack,TextTrackCue,TextTrackList,WebSocket,WebSocketWorker,Worker,XMLHttpRequest,XMLHttpRequestEventTarget,XMLHttpRequestUpload".split(",");for(o=0;o<c.length;++o)a=c[o],r[a]&&r[a].prototype&&l(i,r[a].prototype)}return e.captureUnhandledRejections&&(i._unhandledRejectionHandler=function(r){var e=r.reason,o=r.promise,n=r.detail;!e&&n&&(e=n.reason,o=n.promise),i.unhandledRejection(e,o)},r.addEventListener("unhandledrejection",i._unhandledRejectionHandler)),r[n]=i,i})()},a.prototype.loadFull=function(r,e,n,t,a){var i=function(){var e;if(void 0===r._rollbarPayloadQueue){var o,n,t,i;for(e=new Error("rollbar.js did not load");o=r._rollbarShimQueue.shift();)for(t=o.args,i=0;i<t.length;++i)if(n=t[i],"function"==typeof n){n(e);break}}"function"==typeof a&&a(e)},l=!1,c=e.createElement("script"),p=e.getElementsByTagName("script")[0],s=p.parentNode;c.crossOrigin="",c.src=t.rollbarJsUrl,c.async=!n,c.onload=c.onreadystatechange=o(function(){if(!(l||this.readyState&&"loaded"!==this.readyState&&"complete"!==this.readyState)){c.onload=c.onreadystatechange=null;try{s.removeChild(c)}catch(r){}l=!0,i()}}),s.insertBefore(c,p)},a.prototype.wrap=function(r,e){try{var o;if(o="function"==typeof e?e:function(){return e||{}},"function"!=typeof r)return r;if(r._isWrap)return r;if(!r._wrapped){r._wrapped=function(){try{return r.apply(this,arguments)}catch(e){throw"string"==typeof e&&(e=new String(e)),e._rollbarContext=o()||{},e._rollbarContext._wrappedSource=r.toString(),window._rollbarWrappedError=e,e}},r._wrapped._isWrap=!0;for(var n in r)r.hasOwnProperty(n)&&(r._wrapped[n]=r[n])}return r._wrapped}catch(e){return r}};for(var p="log,debug,info,warn,warning,error,critical,global,configure,scope,uncaughtError,unhandledRejection".split(","),s=0;s<p.length;++s)a.prototype[p[s]]=i(p[s]);r.exports={Rollbar:a,_rollbarWindowOnError:n}},function(r,e){"use strict";r.exports=function(r,e){return function(o){if(!o&&!window._rollbarInitialized){var n=window.RollbarNotifier,t=e||{},a=t.globalAlias||"Rollbar",i=window.Rollbar.init(t,r);i._processShimQueue(window._rollbarShimQueue||[]),window[a]=i,window._rollbarInitialized=!0,n.processPayloads()}}}}]);
        // End Rollbar Snippet
    </script>


@endif

@section('moar_scripts')
    <script type="text/javascript">
        $('.subnav').affix({
            offset: {
                top: $('#navtop').height()
        }
        });
    </script>
@show




</body>
</html>
