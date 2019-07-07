@extends('layouts.app')

@section('title')
 Home
@endsection

@section('content')
	<div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-heading">
                        <div class="panel-control">
                        </div>
                        <h3 class="panel-title">Tags</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Tags</h3>
                    </div>
                    <div class="panel-body">
                    	<ul class="list-inline mar-hor pad-btm bord-btm">
                    		@foreach ($tags as $tag)
			                	<li class="tag tag-lg"><a href="porn/tag/{{$tag['id']}}"><i class="fa fa-tag fa-1x" aria-hidden="true"></i> {{ ucfirst($tag['name']) }}</a></li>
			                @endforeach
			            </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
