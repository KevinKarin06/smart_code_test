@extends('layout.app')

@section('title', 'Page Title')

@section('content')
<h3>Latest News</h3>
@if(count($data)>0)
@foreach($data as $article)
<div id="card-sm" class="col-8 col-sm-8 col-md-6">
    <div class="card mb-5">
        <img src={{$article['img_url']}} class="card-img-top" alt="...">
        <div class="card-body">
            <h5 class="card-title">
                <a href="{{route('article.show',$article->id??$article->title)}}"> {{$article['title']}}</a>
            </h5>
            <p class="card-text">{{$article['description']}}</p>
        </div>
    </div>
</div>
@endforeach
{{$data->links()}}
@else
<div class="no-article">No Content</div>
@endif
@endsection