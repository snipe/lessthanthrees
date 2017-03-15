@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">


            <div id="vue-wrapper">
                <div class="content">
                    <div class="form-group row">
                        <div class="col-md-8">
                            <input type="text" class="form-control" id="name" name="name"
                                   required v-model="newItem.name" placeholder=" Enter some name">

                        </div>
                        <div class="col-md-4">
                            <button class="btn btn-primary" @click.prevent="createItem()"
                                    id="name" name="name">
                                <span class="glyphicon glyphicon-plus"></span> ADD
                            </button>
                        </div>
                    </div>
                    <p class="text-center alert alert-danger"
                       v-bind:class="{ hidden: hasError }">Please enter some value!</p>
                    {{ csrf_field() }}
                    <p class="text-center alert alert-success"
                       v-bind:class="{ hidden: hasDeleted }">Deleted Successfully!</p>
                    <div class="table table-borderless" id="table">
                        <table class="table table-borderless" id="table">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tr v-for="item in items">
                                <td>@{{ item.id }}</td>
                                <td>@{{ item.name }}</td>
                                <td @click.prevent="deleteItem(item)" class="btn btn-danger"><span
                                            class="glyphicon glyphicon-trash"></span></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>



        </div>
    </div>
</div>
@endsection
