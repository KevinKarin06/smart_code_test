@extends('layout.admin')

@section('title', 'Articles')

@section('content')
<div class="cat-header">
    <h3>Articles</h3>
    <a class="btn btn-primary" href="{{route('article.create')}}" role="button">Add New Article</a>
</div>
<div class="admin-articles">
    @if (session('article-deleted'))
    <div class="alert alert-success">
        {{ session('article-deleted') }}
    </div>
    @endif
    <table class="table table-striped caption-top">
        <caption>List of Articles</caption>
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Description</th>
                <th scope="col">Breaking News</th>
                <th scope="col">View</th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach($articles as $article)
            <tr>
                <th scope="row">{{$article->id}}</th>
                <td>{{$article->title}}</td>
                <td>{{$article->description}}</td>
                <td>{{$article->breaking?'Yes':'No'}}</td>
                <td><a class="btn btn-primary" role="button" target="_blank" href="{{route('article.show',$article->id)}}">View</a></td>
                <td><a class="btn btn-secondary" role="button" href="{{route('article.edit',$article->id)}}">Edit</a></td>
                <td>
                    <form action="{{route('article.destroy',$article->id)}}" method="post">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection