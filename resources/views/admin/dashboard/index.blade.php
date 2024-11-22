@extends('admin.app')
@section('title') Dashboard @endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-dashboard"></i> Dashboard</h1>
        </div>
    </div>
    <div class="row">
        @if(Auth()->user())
        @if(auth()->user()->role != 'user')
        <div class="col-md-6 col-lg-3">
            <div class="widget-small primary coloured-icon">
                <i class="icon fa fa-users fa-3x"></i>
                <div class="info">
                    <h4>Utilisateurs</h4>
                    <p><b>{{$usersCount }}</b></p>
                </div>
            </div>
        </div>
        @endif
        @endif
        <div class="col-md-6 col-lg-3">
            <div class="widget-small info coloured-icon">
                <i class="icon fa fa-thumbs-o-up fa-3x"></i>
                <div class="info">
                    <h4> Tâches finies</h4>
                    <p><b>{{$completedTasks }}</b></p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="widget-small warning coloured-icon">
                <i class="icon fa fa-files-o fa-3x"></i>
                <div class="info">
                    <h4>Tâches en cours</h4>
                    <p><b>{{$Nomcompleted}}</b></p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="widget-small danger coloured-icon">
                <i class="icon fa fa-star fa-3x"></i>
                <div class="info">
                    <h4>Total de tâches</h4>
                    <p><b>{{$tasksCount}}</b></p>
                </div>
            </div>
        </div>
    </div>
@endsection