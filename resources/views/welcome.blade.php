@extends('layouts.app')

@section('content')


    <!-- Contact Section -->
    <section id="contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>What Is LessThanThrees?</h2>
                    <hr class="star-primary">
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4 col-lg-offset-2">
                    <p>
                        {{ config('app.name') }} allows you to quickly and easily share collections of things you love.
                        Curate your own movie recommendations, book lists and more!</p>
                </div>
                <div class="col-lg-4">
                    <p>
                        Look for an API coming soon, automatic linking and thumbnails, and more flexibility in list creation and sorting!
                    </p>
                </div>
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    @if (Auth::check())
                    <a href="{{ route('home')  }}" class="btn btn-success btn-lg">
                        Add Items
                    </a>
                    <a href="{{ Auth::user()->getProfileUrl()  }}" class="btn btn-success btn-lg">
                        View Profile
                    </a>
                    @else
                        <a href="{{ config('app.url') }}/login" class="btn btn-success btn-lg">
                            Login / Register
                        </a>

                        <br>(It's free!)
                    @endif
                </div>

            </div>
        </div>
    </section>



    <div id="vue-wrapper">
    </div>



@endsection
