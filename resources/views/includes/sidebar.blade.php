<div class="flex-shrink-0 p-3 text-bg-dark min-vh-100">
    <a href="{{route('lots.index')}}" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
        <svg class="bi pe-none me-2" width="30" height="24"><use xlink:href="#bootstrap"></use></svg>
        <span class="fs-5 fw-semibold">Home</span>
    </a>
    <hr>
    <ul class="list-unstyled ps-0">
        <li class="mb-1">
            <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed {{request()->route()->named('lots.*') ? 'btn-light' : 'text-white'}}"
                    data-bs-toggle="collapse" data-bs-target="#home-collapse" aria-expanded="false">
                Lots
            </button>

            <div class="collapse" id="home-collapse">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                    <li><a href="{{route('lots.index')}}" class="link-light d-inline-flex text-decoration-none rounded">List</a></li>
                    <li><a href="{{route('lots.create')}}" class="link-light d-inline-flex text-decoration-none rounded">Create</a></li>
                </ul>
            </div>
        </li>
        <li class="mb-1">
            <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed {{request()->route()->named('categories.*') ? 'btn-light' : 'text-white'}}"
                    data-bs-toggle="collapse" data-bs-target="#dashboard-collapse" aria-expanded="false">
                Categories
            </button>
            <div class="collapse" id="dashboard-collapse">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                    <li><a href="{{route('categories.index')}}" class="link-light d-inline-flex text-decoration-none rounded">List</a></li>
                    <li><a href="{{route('categories.create')}}" class="link-light d-inline-flex text-decoration-none rounded">Create</a></li>
                </ul>
            </div>
        </li>
    </ul>
</div>
