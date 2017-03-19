@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <div id="vue-wrapper">

                    <form id="main" v-cloak>
                        <div class="bar">
                            <!-- Create a binding between the searchString model and the text field -->
                            <input type="text" v-model="searchString" placeholder="Enter your search terms" />
                        </div>
                    </form>


                    <div class="content">
                        <div class="form-group row">
                            <div class="col-md-4">
                                <input type="text" class="form-control" id="name" name="name"
                                       required v-model="newItem.name" placeholder="Name of a thing you love" @keyup.enter="createItem">

                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control" id="description" name="description"
                                       required v-model="newItem.description" placeholder="Why do you love it?"  @keyup.enter="createItem">

                            </div>
                            <div class="col-md-2">
                                <select name="category_id" class="form-control" v-model="newItem.category_id">
                                    @foreach ($categories as $menu_category)
                                        <option value="{{ $menu_category->id }}">{{ $menu_category->name }}</option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="col-md-1">
                                <button class="btn btn-primary" @click.prevent="createItem()" id="name" name="name">
                                    <span class="glyphicon glyphicon-plus"></span> ADD
                                </button>
                            </div>
                        </div>
                        <p class="text-center alert alert-danger"
                           v-bind:class="{ hidden: hasError }">Please enter a value!</p>
                        {{ csrf_field() }}
                        <p class="text-center alert alert-success"
                           v-bind:class="{ hidden: hasDeleted }">Deleted Successfully!</p>

                        <div v-show="items.length" v-cloak>
                                <span class="item-count">
                                  <strong>@{{ remaining }}</strong> @{{ remaining | pluralize }}
                                </span>
                        </div>
                        <transition>
                        <div class="table table-borderless" id="table" v-if="items.length > 0">

                            <div v-if="loading" v-cloak>
                                <i class="fa fa-circle-o-notch fa-spin fa-3x fa-fw"></i>
                                <span>Loading...</span>
                            </div>



                            <table class="table table-borderless" id="table">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Notes</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tr v-for="item in filteredItems">
                                    <td>
                                        <label @dblclick="editItem(item)">
                                            @{{ item.name }}
                                        </label>
                                    </td>
                                    <td>@{{ item.category.name }}</td>
                                    <td>@{{ item.description }}</td>
                                    <td>

                                        <a @click.prevent="deleteItem(item)" class="btn btn-heart heart-grey no-border">
                                            <i class="fa fa-times"></i>
                                        </a>
                                    </td>
                                </tr>
                            </table>
                        </div>
                            <p v-else>Sorry, no items found.</p>
                        </transition>
                    </div>
                </div>


            </div>
        </div>
    </div>


@endsection
