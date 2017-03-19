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
                            <div v-if="loading" v-cloak>
                                <i class="fa fa-circle-o-notch fa-spin fa-3x fa-fw"></i>
                                <span>Loading...</span>
                            </div>

                            <table class="table table-borderless" id="table">
                                <thead>
                                <tr>
                                    @if (Auth::check())
                                    <th></th>
                                    @endif
                                    <th>Name</th>
                                        @if (!isset($category))
                                        <th>Category</th>
                                        @endif
                                    <th>Notes</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tr v-for="item in items">
                                    @if (Auth::check())
                                    <td> <a class="btn btn-default heart-grey no-border" @click="faveItem(item)">
                                        <i class="fa fa-heart "></i></a>
                                    </td>
                                    @endif
                                    <td>
                                        @{{ item.name }}
                                    </td>
                                        @if (!isset($category))
                                            <td>@{{ item.category.name }}</td>
                                        @endif
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
