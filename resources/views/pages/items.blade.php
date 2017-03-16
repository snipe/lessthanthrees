@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div id="vue-wrapper">

                <div class="table table-borderless" id="table">
                    <table class="table table-borderless" id="table">
                        <thead>
                        <tr>
                            <th class="col-md-4">Name</th>
                            <th class="col-md-7">Notes</th>
                            <th class="col-md-1"></th>
                        </tr>
                        </thead>

                        <tr v-for="item in items">
                            <td>@{{ item.name }}</td>
                            <td>@{{ item.description }}</td>
                            <td>
                                <a @click.prevent="faveItem(item)" class="heart-grey">
                                    <span class="glyphicon glyphicon-heart"></span></a>
                            </td>
                        </tr>
                    </table>


                </div>
            </div>
        </div>
    </div>
@endsection
