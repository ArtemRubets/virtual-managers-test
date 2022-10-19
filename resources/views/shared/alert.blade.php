@php
    $color = session()->get('response.status') ? 'success' : 'danger';
@endphp

<div class="alert alert-{{$color}} alert-dismissible fade show" role="alert">
    {{session()->get('response.message')}}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
