@extends('layout.admin')

@section('title', 'Page Title')

@section('content')
<h3>Dashboard</h3>
<div class="metrics row gx-5">
    <div class="card col-md-4 text-bg-primary mb-3" style="max-width: 18rem;">
        <div class="card-header">Header</div>
        <div class="card-body">
            <h5 class="card-title">Primary card title</h5>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        </div>
    </div>
    <div class="card col-md-4 text-bg-primary mb-3" style="max-width: 18rem;">
        <div class="card-header">Header</div>
        <div class="card-body">
            <h5 class="card-title">Primary card title</h5>
            <p class="card-text">{{$category->count()}}</p>
        </div>
    </div>
</div>
@endsection