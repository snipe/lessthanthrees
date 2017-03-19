@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <div id="vue-wrapper">

                    <div class="content">

                        <form id="main" v-cloak>
                            <div class="bar">
                                <!-- Create a binding between the searchString model and the text field -->
                                <input type="text" v-model="searchString" placeholder="Enter your search terms" />
                            </div>
                        </form>


                        <div class="col-md-12 text-center" v-if="loading" v-cloak>
                            <i class="fa fa-circle-o-notch fa-spin fa-3x fa-fw loading"></i>
                            <span>Loading...</span>
                        </div>


                        <div v-show="items.length" v-cloak>
                                <span class="item-count">
                                  <strong>@{{ remaining }} @{{ remaining | pluralize }}</strong>
                                </span>
                        </div>


                        <transition>
                        <div class="table table-borderless" id="table" v-if="items.length > 0">

                            <table class="table table-borderless" id="table">
                                <thead>
                                <tr>
                                    @if (Auth::check())
                                    <th class="col-md-1"></th>
                                    @endif
                                    <th class="col-md-3">Name</th>
                                        @if (!isset($category))
                                        <th>Category</th>
                                        @endif
                                    <th class="col-md-8">Notes</th>
                                </tr>
                                </thead>
                                <tr v-for="item in filteredItems">
                                    @if (Auth::check())
                                    <td>
                                        <a class="btn btn-heart heart-grey no-border" v-on:click="showAsFaved = !showAsFaved"  @click.prevent="faveItem(item)">
                                            <i class="fa fa-heart"></i>
                                        </a>
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
                        </transition>
                    </div>
                </div>


            </div>
        </div>
    </div>


@endsection
