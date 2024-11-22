@extends('admin.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Show task</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('tasks.index') }}"> Back</a>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                {{ $task->title }}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Description:</strong>
                {{ $task->description }}
            </div>
        </div>

       {{--  <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Status:</strong>
                @if($task->completed)
                    <span class="label label-success">Completed</span>
                @else
                    <span class="label label-danger">Pending</span>
                @endif
            </div>
        </div> --}}

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Due Date:</strong>
                {{ $task->due_date }}
            </div>
        </div>

       
    
        
    </div>
@endsection
<p class="text-center text-primary"><small>Details</small></p>