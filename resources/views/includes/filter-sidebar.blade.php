<div class="flex-shrink-0 p-3 text-bg-dark min-vh-100">
    <h3>Filters</h3>
    <hr>

    <h4>Categories</h4>

    <form action="/">
        @foreach($categories as $category)
            <div class="form-check">
                <input class="form-check-input" type="checkbox"
                       value="{{$category->slug}}"
                       name="categories[]"
                       id="flexCheck_{{$category->id}}"
                       @if(in_array($category->slug, $selected)) checked @endif
                >

                <label class="form-check-label" for="flexCheck_{{$category->id}}">
                    {{$category->name}}
                </label>
            </div>
        @endforeach

        <div class="d-flex justify-content-between">
            <button class="btn btn-primary mt-2" type="submit">Apply</button>
            <a href="{{route('lots.index')}}" class="btn btn-danger mt-2">Reset</a>
        </div>
    </form>

</div>
