@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">

                <h2>Is my data safe with you?</h2>

                <p>We take your security and privacy as seriously as we take our own.
                    We will never sell or share your personal information with anyone,
                    and we'll never email you without permission. We offer the ability to
                    register and login with your social media accounts to make
                    your life easier, but we do not ever post anything on your behalf to your
                    social accounts without your explicit permission. When you login with your social account,
                    we do grab your email address, but that's just for account recovery, and
                    we don't add you to any lists.</p>

                <p>If you opt to create an account manually, your passwords are stored in a
                    one-way hash on the server.  </p>

                <p>If you sign up for a paid plan (and you totally should!), your credit card
                    information gets submitted directly to our merchant account provider over an
                    encrypted TLS connection. We don't even have access to your payment information, just
                    the status of the payment transaction. </p>

                <h2>Who runs LessThanThrees?</h2>

                <p>LessThanThrees is a service provided by Grokability, Inc., creators of such
                    fine open source products as <a href="https://snipeitapp.com">Snipe-IT Asset Management</a>.
                    Writing cool software that makes people's lives easier is sort of our jam. </p>

                <div id="vue-wrapper">
                </div>
            </div>
        </div>
    </div>
@endsection
