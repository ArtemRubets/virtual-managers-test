@extends('layouts.app')
@section('main')
    <div class="row">
        <div class="col-2 px-0">
            @include('includes.sidebar')
        </div>
        <div class="col-10 py-4">
            <h4>Lot name:</h4>
            <div>{{$lot->name}}</div>

            <h4>Lot description:</h4>
            <div>{{$lot->description}}</div>

            <div>
                <h4>Lot categories:</h4>
                <ul>
                    @foreach($lot->categories as $category)
                        <li>{{$category->name}}</li>
                    @endforeach
                </ul>
            </div>

            <a class="btn btn-primary btn-lg" href="{{route('lots.edit', $lot)}}">Edit</a>
        </div>
    </div>
@endsection
