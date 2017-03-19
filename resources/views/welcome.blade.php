@extends('layouts.app')

@section('content')

    <!-- Populated Lists -->
    @if (isset($categories))
        <div class="container">
            <div class="col-lg-12 centered-pills">
                <ul class="nav nav-pills" role="tablist">

                @foreach ($categories as $category)
                    @if (!empty($categoryCounts[$category->name]))
                        <li role="presentation"><a class="text-uppercase" href="{{ url('/') }}/{{ $category->slug }}">
                                <i class="{{ $category->icon }}"></i> {{ $category->name }}
                                <span class="badge">{{ $categoryCounts[$category->name] }}</span>
                            </a>
                        </li>
                    @else
                        <li role="presentation" class="disabled">
                            <a class="text-uppercase"><i class="{{ $category->icon }}"></i> {{ $category->name }}</a>
                        </li>
                    @endif
                @endforeach
                </ul>
            </div>
        </div>

    @endif

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
                        Look for an API coming soon, automatic linking and thumbnails, more sub-categories/genres, and more flexibility in list creation and sorting!
                    </p>
                </div>
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    @if (Auth::check())
                    <a href="{{ config('app.url') }}/home" class="btn btn-success btn-lg">
                        Add Items
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
