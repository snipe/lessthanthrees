@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <div id="vue-wrapper">

                    <div class="content">
                        <div class="footer" v-show="items.length" v-cloak>
                            <span class="item-count">
                              <strong>@{{ remaining }}</strong> @{{ remaining | pluralize }}
                            </span>
                        </div>
                        <div class="table table-borderless" id="table">
                            <table class="table table-borderless" id="table">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Notes</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tr v-for="item in items">
                                    <td> <a class="heart-grey" @click="faveItem(item)">
                                        <i class="fa fa-heart "></i></a></td>
                                    <td>
                                        @{{ item.name }}
                                    </td>
                                    <td>@{{ item.category.name }}</td>
                                    <td>@{{ item.description }}</td>

                                </tr>
                            </table>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>


@endsection
