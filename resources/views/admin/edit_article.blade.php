@extends('layout.admin')

@section('title', 'Update Article')

@section('content')
<h3>Update Article</h3>
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
    @if (session('article-updated'))
    <div class="alert alert-success">
        {{ session('article-updated') }}
    </div>
    @endif
    <form class="row g-3" action="{{route('article.update',$article->id)}}" method="post" enctype="multipart/form-data">
        @method('put')
        @csrf
        <div class="col-md-6">
            <label for="inputEmail4" class="form-label">Title</label>
            <input type="text" name="title" required value="{{$article->title}}" class="form-control" id="inputEmail4" placeholder="Title">
        </div>
        <div class="col-md-6">
            <label for="inputPassword4" class="form-label">description</label>
            <input type="text" value="{{$article->description}}" name="description" class="form-control" id="inputPassword4" placeholder="Description">
        </div>
        <div class="col-md-3">
            <img src="{{$article->img_url}}" alt="" class="img-fluid" srcset="">
        </div>
        <div class="col-4">
            <label for="formFile" class="form-label">Select Article thumbnail</label>
            <input class="form-control" name="img" type="file" id="formFile">
        </div>
        <div class="col-md-5">
            <label for="inputState" class="form-label">Category</label>
            <select id="sel1" name="category[]" multiselect-hide-x="true" class="form-select" multiple>
                <option disabled value="-1" selected>Select Category</option>
                @foreach($category as $key => $cat)
                <option {{ isset($article) && in_array($cat->id, $article->categories()->pluck('category_id')->toArray()) ? 'selected' : '' }} value="{{$cat->id}}">{{$cat->title}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-12">
            <label for="inputCity" class="form-label">Content</label>
            <textarea class="form-control" value="{{$article->content}}" name="content" id="exampleFormControlTextarea1" rows="3">{{$article->content}}</textarea>
        </div>
        <div class="col-12">
            <div class="form-check">
                <input @checked(old('breaking', $article->breaking)) class="form-check-input" name="breaking" type="checkbox" id="gridCheck">
                <label class="form-check-label" for="gridCheck">
                    Breaking News
                </label>
            </div>
        </div>
        <div class="row {{$article->breaking?'':'d-none'}}" id="breaking-block">
            <div class="col-6">
                <label for="inputPassword4" class="form-label">Banner Text</label>
                <input type="text" value="{{$article->breaking_text}}" name="banner_text" class="form-control" id="inputPassword4" placeholder="Breaking News">
            </div>
            <div class="col-6">
                <label for="exampleColorInput" class="form-label">Banner Color</label>
                <input type="color" name="color" value="{{$article->color}}" class="form-control form-control-color" id="exampleColorInput" title="Choose your color">
            </div>
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>
</div>
@endsection