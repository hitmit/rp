@extends('layouts.app')

@section('title')
 Home
@endsection

@section('content')
  <porn-category-component category_id="{{$category_id}}" :category_list="{{$categories}}"></porn-category-component>
@endsection
