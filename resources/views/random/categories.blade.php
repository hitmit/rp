@extends('layouts.app')

@section('title')
 Home
@endsection

@section('content')
  <porn-categories-component :category_list="{{$categories}}"></porn-categories-component>
@endsection
