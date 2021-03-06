@extends('layouts.app')

@section('title')
    {{ $workitem->title }}
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h1 style="text-align: center">{{ $workitem->title}}</h1>
            </div>
        </div>

        <hr/>

        <div class="row">
            <div class="col-md-3">
                <div class="panel panel-default panel-flush">
                    <div class="panel-heading">
                        Actions <i class="fa fa-bolt" aria-hidden="true"></i>
                    </div>

                    <div class="panel-body">
                        <div class="spark-settings-tabs">
                            <ul class="nav spark-settings-stacked-tabs" role="tablist">

                                <li role="presentation">
                                    <a href="">
                                        <i class="fa fa-indent" aria-hidden="true"></i>
                                        Type:
                                        {{ $workitem->type}}
                                    </a>
                                </li>

                                <li role="presentation">
                                    <a href="">
                                        <i class="fa fa-sort" aria-hidden="true"></i>
                                        Priority level:
                                        {{ $workitem->priority}}
                                    </a>
                                </li>

                                <li role="presentation">
                                    <a href="">
                                        <i class="fa fa-wrench" aria-hidden="true"></i>
                                        Status:
                                        {{ $workitem->status}}
                                    </a>
                                </li>

                                <li role="presentation">
                                    <a href="">
                                        <i class="fa fa-hourglass-half" aria-hidden="true"></i>
                                        Estimated time:
                                        {{ $workitem->estimated_time}}
                                        hour(s)
                                    </a>
                                </li>

                                @if(!is_null($workitem->assignedUser))
                                    <li role="presentation">
                                        <a href="{{ route('profile.show', ['user' => $workitem->assignedUser->id]) }}">
                                            <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                                            Assigned to: {{ $workitem->assignedUser->full_name }}
                                        </a>
                                    </li>
                                @endif

                                <li role="presentation">
                                    <a href="">
                                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                        Created:
                                        <abbr title="{{ $workitem->created_at->toDayDateTimeString() }}">
                                            {{ $workitem->created_at->diffForHumans()}}
                                        </abbr>
                                    </a>
                                </li>

                                <li role="presentation">
                                    <a href="">
                                        <i class="fa fa-calendar" aria-hidden="true"></i>
                                        Updated:
                                        <abbr title="{{ $workitem->updated_at->toDayDateTimeString() }}">
                                            {{ $workitem->updated_at->diffForHumans()}}
                                        </abbr>
                                    </a>
                                </li>
                            </ul>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-9">
                <div class="panel panel-default">

                    <div class="panel-body">
                        @if(session('success_message'))
                            <div class="alert alert-success">
                                {{ session('success_message') }}
                            </div>
                        @endif

                        @if(count($errors))
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li> {{ $error }} </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <p class="desc-text text-justify">
                            <b>Work item description:</b>
                            {!! $workitem->description !!}
                        </p>
                    </div>
                    <!--/.panel-body-->

                    <div class="panel-body">
                        @can('modify', [$workitem, $project])
                            <div class="col-md-3 ">
                                <a class="btn btn-primary btn-block"
                                   href="{{ route('work-items.edit', ['project_id' => $project->id, 'work-item_id' => $workitem->id  ]) }}">
                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                    Edit Work item
                                </a>
                            </div>

                            <div class="col-md-3">
                                <form onsubmit="return confirm('Are you sure you want to delete this work item ?')"
                                      action="{{ route('work-items.destroy', ['project_id'=>$project->id, 'id' => $workitem->id  ]) }}"
                                      method="POST">
                                    {{ method_field('DELETE') }}

                                    {{ csrf_field() }}

                                    <button type="submit" class="btn btn-danger btn-block">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                        Delete
                                    </button>
                                </form>
                            </div>
                        @endcan
                    </div>
                    <!--/.panel-body-->


                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

