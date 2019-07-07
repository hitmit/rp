@extends('layouts.app')

@section('title')
 Home
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading">
                    <div class="panel-control">
                    </div>
                    <h3 class="panel-title">Search Results</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        @foreach ($porns as $porn)
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">{{$porn.title}}</h3>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endsection