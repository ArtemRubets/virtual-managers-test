@extends('layouts.app')
@section('main')
    <div class="row">
        <div class="col-2 px-0">
            @include('includes.sidebar')
        </div>
        <div class="col-10 py-2">
            <a href="{{route('categories.create')}}" class="btn btn-primary mb-2">New category</a>

            <table class="table table-success table-striped">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Lot</th>
                    <th scope="col">Created at</th>
                    <th scope="col">Modified</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody class="table-group-divider">
                @foreach($categories as $category)
                        <tr>
                            <th scope="row">{{$category->id}}</th>
                            <td style="width: 55%">
                                <a href="{{route('categories.show', $category)}}" class="text-decoration-none">
                                    {{$category->name}}
                                </a>
                            </td>
                            <td>
                                {{$category->created_at}}
                            </td>
                            <td>
                                {{$category->updated_at}}
                            </td>
                            <td style="width: 15%">
                                <div class="d-flex justify-content-around">
                                    <a href="{{route('categories.edit', $category)}}" class="btn btn-primary">Edit</a>
                                    <form action="{{route('categories.destroy', $category)}}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger">
                                            Delete
                                        </button>
                                    </form>
                                </div>

                            </td>
                        </tr>
                @endforeach
                </tbody>
            </table>

            {{$categories->links()}}
        </div>
    </div>
@endsection
