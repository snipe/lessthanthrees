@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">

                @if (count($items) > 0)
                <div class="table table-borderless" id="table">
                    <table class="table table-borderless" id="table">
                        <thead>
                        <tr>
                            <th class="col-md-4">Name</th>
                            <th class="col-md-8">Notes</th>
                        </tr>
                        </thead>
                        @foreach ($items as $item)
                        <tr>
                            <td><i class="{{ $item->category->icon }}"></i> {{ $item->name }}</td>
                            <td>{{ $item->description }}</td>
                        </tr>
                        @endforeach
                    </table>
                @else
                        <p>Nothing here yet!</p>
                @endif

                <div id="vue-wrapper">
                </div>
            </div>
        </div>
    </div>
@endsection
