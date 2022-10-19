@extends('layouts.app')
@section('main')
    <div class="row">
        <div class="col-2 px-0">
            @include('includes.sidebar')
        </div>
        <div class="col-10 py-4">
            <h4>Category name:</h4>
            <div>{{$category->name}}</div>

            <h4>Category slug:</h4>
            <div>{{$category->slug}}</div>

            <a class="btn btn-primary btn-lg" href="{{route('categories.edit', $category)}}">Edit</a>
        </div>
    </div>
@endsection

