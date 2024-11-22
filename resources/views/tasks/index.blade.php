
@extends('admin.app')

@section('content')

<div class="row">
        <div class="col-lg-12 margin-tb">
           
            <div class="pull-right">
             
                <a class="btn btn-success" href="{{ route('tasks.create') }}"> Create New Task</a>
                
            </div>
        </div>
    </div>



    <!-- resources/views/tasks/index.blade.php -->

<div class="container">
    <div class="CRUD ToDoList">
        <h1>Task List</h1>
        
        <!-- Boutons d'exportation -->
        <div class="export-buttons">
            <a href="{{ url('tasks/export-excel') }}" class="btn btn-success">Exporter en Excel</a>
            <a href="{{ url('tasks/export-csv') }}" class="btn btn-warning">Exporter en CSV</a>
            <a href="{{ url('tasks/export-pdf') }}" class="btn btn-danger">Exporter en PDF</a>
        </div>

        <!-- Affichage des tâches -->
        <table class="table table-striped" border="3">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Titre</td>
                    <td>Auteur</td>
                    <td>Description</td>
                    <td>Status(Completed)</td>
                    <td>Date d'écheance</td>
                    <td colspan="2">Action</td>
                </tr>
            </thead>
            <tbody>
                @foreach($tasks as $task)
                <tr>
                    <td>{{$task->id}}</td>
                    <td>{{$task->title}}</td>
                    <td>{{$task->user->last_name}}  {{$task->user->first_name}}</td>
                    <td>{{$task->description}}</td>
                    <td>
                        <a href="task/{{$task->id}}" class="btn btn-sm btn-{{$task->is_completed ? 'success':'danger'}}">
                            {{$task->is_completed ? 'Complété':'En cours'}}
                        </a>
                    </td>
                    <td>
                        @if($task->due_date)
                        {{ $task->due_date }}
                        @endif
                    </td>
                    <td>
                        <form action="{{ route('tasks.destroy',$task->id) }}" method="POST">
                            <a class="btn btn-info" href="{{ route('tasks.show',$task->id) }}">Show</a>
                            <a class="btn btn-primary" href="{{route('tasks.edit', $task->id)}}">Edit</a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-xs btn-danger btn-flat show_confirm" data-toggle="tooltip" title="Delete">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination -->
      
    </div>
</div>

 {{--    <div class="container">
        <div class="CRUD ToDoList">
            <h1>Task List</h1>
            <table class="table table-striped" border="3">
                <thead>
                    <tr>
                      <td>ID</td>
                      <td>Titre</td>
                      <td>Auteur</td>
                      <td>Description</td>
                      <td>Status(Completed)</td>
                      <td>Date d'écheance</td>
                      <td colspan="2">Action</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tasks as $task)
                    <tr>
                        <td>{{$task->id}}</td>
                        <td>{{$task->title}}</td>
                        <td>{{$task->user->last_name}}  {{$task->user->first_name}}</td>
                        <td>{{$task->description}}</td>
                        <td>
                          

                            <a href="task/{{$task->id}}" class="btn btn-sm btn-{{$task->is_completed ? 'success':'danger'}}">
                                {{$task->is_completed ? 'Complted':'In progress'}}
                            </a>
                        </td>


                        </td>
                        <td>
                            @if($task->due_date)
                            {{ $task->due_date }}
                            @endif
                        </td>


                        
                        <td>
                            <form action="{{ route('tasks.destroy',$task->id) }}" method="POST">
                                <a class="btn btn-info" href="{{ route('tasks.show',$task->id) }}">Show</a>
                                <a class="btn btn-primary" href="{{route('tasks.edit', $task->id)}}">Edit</a>
                                @csrf
                            <input name="_method" type="hidden" value="DELETE">
                            <button type="submit" class="btn btn-xs btn-danger btn-flat show_confirm" data-toggle="tooltip" title='Delete'>Delete</button>
                    
                            </form>
                        </td>

                        <td>

                        </td>
                    </tr>
                    @endforeach
                </tbody>
              </table>

        </div>
    </div> --}}



@endsection

  


