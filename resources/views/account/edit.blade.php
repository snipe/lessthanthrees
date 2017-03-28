@extends('layouts.app')

@section('content')
    <div id="edit-profile">


    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">

                <div class="panel panel-login">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-12 text-left">
                                <a href="#" class="active">Profile Information</a>
                            </div>
                        </div>
                        <hr>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <form action="{{ route('account.save') }}" id="profile-form" method="post" role="form" style="display: block;">
                                    {{ csrf_field() }}

                                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                        <div class="row">
                                            <label class="field col-md-3" for="name">Name:</label>
                                            <div class="required-field-block col-md-9">
                                                <input class="form-control col-md-12" data-name="Name" id="name" maxlength="256" name="name" placeholder="Enter your name" type="text"  value="{{ old('name', Auth::user()->name) }}" autofocus>
                                                <div class="required-icon">
                                                    <div class="text">*</div>
                                                </div>
                                                @if ($errors->has('name'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('name') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                                        <div class="row">
                                            <label class="field col-md-3" for="username">Username:</label>
                                            <div class="required-field-block col-md-9">
                                                <input  class="form-control col-md-12" id="email" maxlength="200" name="username" placeholder="your-username" type="text" v-model="username" value="{{ old('username', Auth::user()->username) }}">
                                                <div class="required-icon">
                                                    <div class="text">*</div>
                                                </div>
                                                <p class="help-block">This field may contain only letters, numbers and dashes, and will be used as your subdomain: https://@{{ username }}.lessthanthrees.com</p>
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
                                            <label class="field col-md-3" for="email">Email Address:</label>
                                            <div class="required-field-block col-md-9">
                                                <input  class="form-control col-md-12" data-name="Email" id="email" maxlength="256" name="email" placeholder="Enter your email address" type="email" value="{{ old('email', Auth::user()->email) }}" required>
                                                <div class="required-icon">
                                                    <div class="text">*</div>
                                                </div>
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
                                            <label class="field col-md-3" for="password">{{ Auth::user()->password=='' ? 'Create ' : 'Update' }} Password:</label>
                                            <div class="{{ Auth::user()->profilePasswordIsRequired() ? 'required-field-block ' : '' }}col-md-9">
                                                <input  class="form-control col-md-12" id="password" maxlength="60" name="password" type="password">
                                                @if (Auth::user()->profilePasswordIsRequired())
                                                    <div class="required-icon">
                                                        <div class="text">*</div>
                                                    </div>
                                                @endif

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
                                            <label class="field col-md-3" for="password_confirmation">Password Confirmation:</label>
                                            <div class="{{ Auth::user()->profilePasswordIsRequired() ? 'required-field-block ' : '' }}col-md-9">
                                                <input  class="form-control col-md-12" maxlength="60" name="password_confirmation" type="password">

                                                @if (Auth::user()->profilePasswordIsRequired())

                                                    <div class="required-icon">
                                                        <div class="text">*</div>
                                                    </div>

                                                @endif
                                                @if ($errors->has('password_confirmation'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>




                                    <div class="form-group col-md-offset-3">
                                        <div class="row">
                                            <div class="col-md-12 text-right">
                                                <input class="submit btn btn-primary" id="save_profile" data-wait="Please wait..." type="submit" value="Save Profile">
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
    </div>

@section('moar_scripts')
    <script>
        var editProfile = new Vue({
            el: '#edit-profile',
            data: {
                username: '{{ ( Auth::user()->username!='') ? old('username', Auth::user()->username) : str_slug(Auth::user()->name) }}'
            }
        })

        $(function() {
            $('.required-icon').tooltip({
                placement: 'left',
                title: 'Required field'
            });
        });


    </script>
@stop
@endsection
