@extends('layout.admin')

@section('title', 'Create Category')

@section('content')
<h3>Create Category</h3>
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
    @if (session('cat-created'))
    <div class="alert alert-success">
        {{ session('cat-created') }}
    </div>
    @endif
    <form class="row g-3" action="{{route('category.store')}}" method="post">
        @csrf
        <div class="col-md-6">
            <label for="inputEmail4" class="form-label">Title</label>
            <input type="text" name="title" required class="form-control" id="inputEmail4" placeholder="Title">
        </div>
        <div class="col-md-6">
            <label for="inputPassword4" class="form-label">description</label>
            <input type="text" name="description" class="form-control" id="inputPassword4" placeholder="Description">
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
</div>
@endsection