@extends('layouts.app')

@section('title')
   {{ $project->name }}
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h1>{{ $project->name}}</h1>
            </div>
        </div>

        <hr/>

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard</div>

                    <div class="panel-body">
                        <p class="desc-text text-justify">
                            <b>Project id:</b>
                            {{ $project->id}}
                        </p>

                        <p class="desc-text text-justify">
                            <b>Project name:</b>
                            {{ $project->name}}
                        </p>

                        <p class="desc-text text-justify">
                            <b>Project description:</b>
                            {{ $project->description}}
                        </p>

                        <p class="desc-text text-justify">
                            <b>Project created at:</b>
                            {{ $project->created_at}}
                        </p>


                        <ul class="controls">

                            <li class="edit">
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                <p class="text-a">Edit</p>
                            </li>

                            <li class="update">
                                <i class="fa fa-wrench" aria-hidden="true"></i>
                                <p class="text-a">Update</p>
                            </li>

                            <li class="trash">
                                <i class="fa fa-trash" aria-hidden="true"></i>
                                <p class="text-a">Delete</p>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

