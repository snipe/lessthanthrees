@extends('layouts.app')

@section('content')


    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
            @if (config('services.twitter.client_id'))
                <div class="col-md-3">
                    <a class="btn btn-block btn-social btn-twitter" href="{{ route('oauth', ['provider'=> 'twitter']) }}">
                        <span class="fa fa-twitter"></span> Twitter
                    </a>
                </div>
            @endif

            @if (config('services.facebook.client_id'))
                <div class="col-md-3">
                    <a class="btn btn-block btn-social btn-facebook" href="{{ route('oauth', ['provider'=> 'facebook']) }}">
                        <span class="fa fa-facebook"></span> Facebook
                    </a>
                </div>
            @endif

            @if (config('services.google.client_id'))
                <div class="col-md-3">
                    <a class="btn btn-block btn-social btn-google" href="{{ route('oauth', ['provider'=> 'google']) }}">
                        <span class="fa fa-google"></span> Google
                    </a>
                </div>
            @endif

            @if (config('services.github.client_id'))
                <div class="col-md-3">
                    <a class="btn btn-block btn-social btn-github" href="{{ route('oauth', ['provider'=> 'github']) }}">
                        <span class="fa fa-github"></span> Github
                    </a>
                </div>
            @endif

            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">



                <div class="panel panel-login">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-6">
                                <a href="#" class="active" id="login-form-link">Login</a>
                            </div>
                            <div class="col-xs-6">
                                <a href="#" id="register-form-link">Register</a>
                            </div>
                        </div>
                        <hr>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <form id="login-form" action="{{ route('login') }}" method="post" role="form" style="display: block;">
                                    {{ csrf_field() }}

                                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                        <div class="row">
                                        <label for="email" class="col-md-3 control-label col-md-offset-1">E-Mail Address</label>
                                            <div class="col-md-6">
                                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                                @if ($errors->has('email'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('email') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                        <div class="row">
                                            <label for="password" class="col-md-3  col-md-offset-1 control-label">Password</label>

                                            <div class="col-md-7">
                                                <input id="password" type="password" class="form-control" name="password" required>
                                                @if ($errors->has('password'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('password') }}</strong>
                                                    </span>
                                                @endif
                                        </div>
                                        </div>
                                    </div>



                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-7 col-md-offset-4">
                                            <input type="checkbox" tabindex="3" class="" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                            <label for="remember"> Remember Me</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-6 col-sm-offset-3">
                                                <input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Log In">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="text-center">
                                                    <a href="{{ route('password.request') }}" tabindex="5" class="forgot-password">Forgot Password?</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                                <form id="register-form" action="{{ route('register') }}" method="post" role="form" style="display: none;">
                                    {{ csrf_field() }}
                                    <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                                        <div class="row">
                                            <label for="username" class="col-md-3  col-md-offset-1 control-label">Username</label>

                                            <div class="col-md-7">
                                                <input id="username" type="text" class="form-control" name="username" required>
                                                @if ($errors->has('username'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('username') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                        <div class="row">
                                            <label for="email" class="col-md-3  col-md-offset-1 control-label">Email</label>

                                            <div class="col-md-7">
                                                <input id="email" type="email" class="form-control" name="email" required>
                                                @if ($errors->has('email'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('email') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                        <div class="row">
                                            <label for="password" class="col-md-3  col-md-offset-1 control-label">Password</label>

                                            <div class="col-md-7">
                                                <input id="password" type="password" class="form-control" name="password" required>
                                                @if ($errors->has('password'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('password') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                        <div class="row">
                                            <label for="password_confirmation" class="col-md-3  col-md-offset-1 control-label">Confirm Password</label>

                                            <div class="col-md-7">
                                                <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required>
                                                @if ($errors->has('password_confirmation'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-6 col-sm-offset-3">
                                                <input type="submit" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-register" value="Register Now">
                                            </div>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
