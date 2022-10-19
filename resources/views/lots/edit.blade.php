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

            <form action="{{route('lots.update', $lot)}}" method="POST">
                @csrf
                @method('PUT')

                <h2>Lot</h2>

                <div class="mb-3">
                    <label for="lotName" class="form-label">Lot name</label>
                    <input type="text" name="name" class="form-control" id="lotName" value="{{old('name', $lot->name)}}"
                           @if($errors->has('name')) style="border-color: #dc3545;" @endif required>

                    @include('shared.error' , ['errorName' => 'name'])
                </div>
                <div class="mb-3">
                    <label for="lotDesc" class="form-label">Lot description</label>
                    <textarea class="form-control" name="description" id="lotDesc" rows="3"
                              @if($errors->has('description')) style="border-color: #dc3545;" @endif required>{{
                        old('description', $lot->description)
                    }}</textarea>

                    @include('shared.error' , ['errorName' => 'description'])
                </div>

                <hr>
                <h2>Categories</h2>

                <div class="mb-3">
                    @foreach($categories as $category)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox"
                                   value="{{$category->id}}"
                                   name="lot_categories[]"
                                   id="flexCheck_{{$category->id}}"

                                   @if($errors->any())
                                       @if(in_array($category->id, old('lot_categories') ?? [])) checked @endif
                                   @else
                                       @if($lot->categories->contains('id', $category->id)) checked @endif
                                @endif
                            >

                            <label class="form-check-label" for="flexCheck_{{$category->id}}">
                                {{$category->name}}
                            </label>
                        </div>
                    @endforeach

                    @include('shared.error' , ['errorName' => 'lot_categories'])

                </div>

                <button class="btn btn-primary btn-lg" type="submit">Update</button>
                <a class="btn btn-secondary btn-lg" href="{{route('lots.show', $lot)}}">View</a>
            </form>

        </div>
    </div>
@endsection
