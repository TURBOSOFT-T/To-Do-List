@extends('admin.app')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('tasks.index') }}"> Back</a>
            </div>
        </div>
    </div>


   


    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card p-3">
                    <h5>Add a new Task</h5>
                    <form action="{{ route('tasks.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-3">
                            <label class="form-label">Task Name</label>
                            <input name="title" required class="form-control" placeholder="Task Name" />
                            @error('title')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label">Date d'écheance</label>
                            <input type="date" name="due_date" required class="form-control" placeholder="Date" />
                            @error('due_date')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description" required class="form-control" placeholder="Description"></textarea>
                            @error('description')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group mt-3">
                            <button class="btn btn-primary w-100">Create Task</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection



