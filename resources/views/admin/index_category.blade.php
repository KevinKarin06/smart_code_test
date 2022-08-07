@extends('layout.admin')

@section('title', 'Categories')

@section('content')
<div class="cat-header">
    <h3>Categories</h3>
    <a class="btn btn-primary" href="{{route('category.create')}}" role="button">Add New Category</a>
</div>
<div class="category">
    @if (session('cat-deleted'))
    <div class="alert alert-success">
        {{ session('cat-deleted') }}
    </div>
    @endif
    <table class="table table-striped caption-top">
        <caption>List of Categories <span>({{$category->count()}})</span></caption>
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Description</th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach($category as $cat)
            <tr>
                <th scope="row">{{$cat->id}}</th>
                <td>{{$cat->title}}</td>
                <td>{{$cat->description}}</td>
                <td><a class="btn btn-secondary" role="button" href="{{route('category.edit',$cat->id)}}">Edit</a></td>
                <td>
                    <form action="{{route('category.destroy',$cat->id)}}" method="post">
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