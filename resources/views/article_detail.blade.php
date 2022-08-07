@extends('layout.app')

@section('title', 'Page Title')

@section('content')
<img src={{$article->img_url}} class="img-fluid" alt="">
<div class="article-detail">
    <div class="row mb-2">
        <div class="col-md-2 col-sm-6">
            <span class="fa-fa-time"></span>
            <p class="text-muted">{{$article->author}}</p>
        </div>
        <div class="col-md-4 col-sm-6">
            <p class="text-muted">{{$article->published_at->isoFormat('MMMM Do YYYY, h:mm:ss a')}}</p>
        </div>
        <div class="col-md-6 col-sm-12">
            @foreach($article->categories as $cat)
            <span class="badge bg-primary rounded-pill">{{$cat->title}}</span>
            @endforeach
        </div>
    </div>
    <h3>{{$article->title}}</h3>
    <p>{{$article->description}}</p>
    <p>{{$article->content}}</p>
</div>
@endsection