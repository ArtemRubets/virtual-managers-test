@extends('layouts.app')
@section('main')
    <div class="row">
        <div class="col-2 px-0">
            @include('includes.sidebar')
        </div>
        <div class="col-8 py-2">
            <a href="{{route('lots.create')}}" class="btn btn-primary mb-2">New lot</a>

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
                @foreach($lots as $lot)
                        <tr>
                            <th scope="row">{{$lot->id}}</th>
                            <td style="width: 55%">
                                <a href="{{route('lots.show', $lot->id)}}" class="text-decoration-none">
                                    {{$lot->name}}
                                </a>
                            </td>
                            <td>
                                {{$lot->created_at}}
                            </td>
                            <td>
                                {{$lot->updated_at}}
                            </td>
                            <td style="width: 15%">
                                <div class="d-flex justify-content-around">
                                    <a href="{{route('lots.edit', $lot->id)}}" class="btn btn-primary">Edit</a>
                                    <form action="{{route('lots.destroy', $lot->id)}}" method="post">
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

            {{$lots->withQueryString()->links()}}
        </div>

        <div class="col-2 px-0">
            @include('includes.filter-sidebar')
        </div>
    </div>
@endsection
