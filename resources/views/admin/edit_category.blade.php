@extends('layout.admin')

@section('title', 'Edit Category')

@section('content')
<h3>Edit Category</h3>
<div class="creat-cat">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    @if (session('cat-updated'))
    <div class="alert alert-success">
        {{ session('cat-updated') }}
    </div>
    @endif
    <form class="row g-3" method="post" action="{{route('category.update',$cat->id)}}">
        @method('PUT')
        @csrf
        <div class="col-md-6">
            <label for="inputEmail4" class="form-label">Title</label>
            <input type="text" name="title" value="{{$cat->title}}" required class="form-control" id="inputEmail4" placeholder="Title">
        </div>
        <div class="col-md-6">
            <label for="inputPassword4" class="form-label">description</label>
            <input type="text" name="description" value="{{$cat->description}}" class="form-control" id="inputPassword4" placeholder="Description">
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>
</div>
@endsection