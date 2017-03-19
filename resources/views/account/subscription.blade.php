@extends('layouts.app')

@section('content')
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
    <div id="vue-wrapper">
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">

                <h2>Why Upgrade?</h2>

                <p>
                    {{ config('app.name') }} will always be a free place for you to collect and share your favorite things, but paid subscribers get some extra cool features:
                </p>

                <ul class="checkmark">
                    <li>Use your own Affiliate IDs and earn money on your recommendations!</li>
                    <li>Hide advertisements for the folks that visit your profile</li>
                </ul>

                <p>
                   Monthly subscriptions are just $4.99 USD, and automatically renew. You can cancel any time through the website, and your existing account information will remain intact.
                </p>

            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">

                <div class="panel panel-login">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-12 text-left">
                                <a href="#" class="active">Payment Information</a>
                            </div>
                         </div>
                        <hr>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <form action="#" id="payment-form" method="post" role="form" style="display: block;">
                                    {{ csrf_field() }}

                                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                        <div class="row">
                                            <label class="field col-md-3" for="name">Name:</label>
                                            <div class="col-md-9">
                                                <input class="form-control col-md-12" data-name="Name" id="name" maxlength="256" name="name" placeholder="Enter your name" type="text"  value="{{ Auth::user()->name }}" required autofocus>
                                                @if ($errors->has('name'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('name') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                        <div class="row">
                                            <label class="field col-md-3" for="email">Email Address:</label>
                                            <div class="col-md-9">
                                                <input  class="form-control col-md-12" data-name="Email" id="email" maxlength="256" name="email" placeholder="Enter your email address" type="email" value="{{ Auth::user()->email }}" required>
                                                @if ($errors->has('email'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('email') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Error box for payment errors -->
                                    <div class="form-group payment-errors alert alert-mini alert-danger margin-bottom-10" style="display: none; margin-left: 15px;">
                                    </div>


                                    <div class="form-group" id="form-card-number">
                                        <div class="row">
                                            <label for="card-number" class="field col-md-3">Card Number<br>
                                                <i class="fa fa-cc-visa help-text"></i>
                                                <i class="fa fa-cc-amex"></i>
                                                <i class="fa fa-cc-mastercard"></i>
                                                <i class="fa fa-cc-diners-club"></i>
                                                <i class="fa fa-cc-jcb"></i>
                                                <i class="fa fa-cc-discover"></i>
                                            </label>
                                            <div class="col-md-9">
                                                <input id="card-number" type="text" class="card-number form-control" size="20" data-stripe="number" {!! (!App::environment('production') ? ' value="4242424242424242"' : '') !!} />
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group col-md-offset-3">

                                        <div class="row">
                                            <div class="col-md-3 col-sm-12">
                                                <label for="exp_month">Month</label>
                                                <input id="exp_month" type="text" class="card-expiry-month form-control" placeholder="01" {!! (!App::environment('production') ? ' value="01"' : '') !!} data-stripe="exp-month">
                                            </div>

                                            <div class="col-md-3 col-sm-12">
                                                <label for="exp_year">Year</label>
                                                <input id="exp_year" type="text" class="card-expiry-year form-control" placeholder="2016" {{ (date('Y') + 3) }}" {!! (!App::environment('production') ? ' value="'.(date('Y') + 3).'"' : '') !!} data-stripe="exp-year">
                                            </div>

                                            <div class="col-md-3 col-sm-9">
                                                <label for="cvc">CVC</label>
                                                <input id="cvc" type="text" class="card-cvc form-control" placeholder="123" {!! (!App::environment('production') ? ' value="123"' : '') !!} data-stripe="cvc" />
                                            </div>

                                            <div class="col-md-3 col-sm-9">
                                                <label for="coupon">Coupon</label>
                                                <input class="form-control col-md-3" data-name="coupon" id="coupon" maxlength="256" name="coupon" type="text">
                                            </div>

                                        </div>


                                    </div>
                                    <div class="form-group col-md-offset-3">

                                        <div class="row">
                                            <div class="col-md-12 text-right">
                                                <input class="submit btn btn-primary" id="payment_signup" data-wait="Please wait..." type="submit" value="Upgrade">
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

@section('moar_scripts')
    @parent
    <script type="text/javascript">
        // This identifies your website in the createToken call below
        Stripe.setPublishableKey('{{ config('services.stripe.key') }}');

        $(function(){
            $('#payment-form').submit(function(event) {
                var $form = $(this);


                // Disable the submit button to prevent repeated clicks
                $('#payment_signup').prop('disabled', true);

                Stripe.card.createToken({
                    number: $('.card-number').val(),
                    cvc: $('.card-cvc').val(),
                    exp_month: $('.card-expiry-month').val(),
                    exp_year: $('.card-expiry-year').val()
                }, stripeResponseHandler);
                return false;
            });
        });

        function stripeResponseHandler(status, response) {
            var $form = $('#payment-form');

            if (response.error) {
                // Show the errors on the form
                $('.payment-errors').show().text(response.error.message);
                $('#payment_signup').prop('disabled', false);
            } else {
                // response contains id and card, which contains additional card details
                var token = response.id;
                // Insert the token into the form so it gets submitted to the server
                $form.append($('<input type="hidden" name="stripeToken" />').val(token));
                // and submit
                $form.get(0).submit();
            }
        };
    </script>

@endsection
@endsection
