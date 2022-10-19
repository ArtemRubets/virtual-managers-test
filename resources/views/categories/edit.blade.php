@extends('layouts.app')
@section('main')
    <div class="row">
        <div class="col-2 px-0">
            @include('includes.sidebar')
        </div>
        <div class="col-10 py-2">

            @if(session()->has('response'))
                @include('shared.alert')
            @endif

            <form action="{{route('categories.update', $category)}}" method="POST">
                @csrf
                @method('PUT')

                <h2>Category</h2>

                <div class="mb-3">
                    <label for="categoryName" class="form-label">Category name</label>
                    <input type="text" name="name" class="form-control" id="categoryName" value="{{old('name', $category->name)}}"
                           @if($errors->has('name')) style="border-color: #dc3545;" @endif required>

                    @include('shared.error' , ['errorName' => 'name'])
                </div>
                <div class="mb-3">
                    <label for="categorySlug" class="form-label">Category slug</label>
                    <input type="text" name="slug" class="form-control" id="categorySlug" value="{{old('slug', $category->slug)}}"
                           @if($errors->has('slug')) style="border-color: #dc3545;" @endif>

                    @include('shared.error' , ['errorName' => 'slug'])
                </div>

                <button class="btn btn-primary btn-lg" type="submit">Update</button>
                <a class="btn btn-secondary btn-lg" href="{{route('categories.show', $category)}}">View</a>
            </form>

        </div>
    </div>
@endsection
