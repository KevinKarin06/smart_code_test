@extends('layout.admin')

@section('title', 'Page Title')

@section('content')
<h3>Dashboard</h3>
<div class="metrics m-auto justify-content-around w-100 row gx-2 px-2">
    <div class="card col-md-5 col-sm-12 text-bg-primary mb-3">
        <div class="card-body">
            <h5 class="card-title">Articles</h5>
            <p class="card-text">{{$totalArticles}}</p>
        </div>
    </div>
    
    <div class="card col-md-5 text-bg-primary col-sm-12 mb-3">
        <div class="card-body">
            <h5 class="card-title">Categories</h5>
            <p class="card-text">{{$totalCategories}}</p>
        </div>
    </div>
</div>
@endsection