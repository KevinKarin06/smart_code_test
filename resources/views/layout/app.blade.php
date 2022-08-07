<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>News App - @yield('title')</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc" crossorigin="anonymous"></script>
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <script src="{{ asset('js/script.js') }}"></script>
    <script src="{{ asset('js/multiselect-dropdown.js') }}"></script>

    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
</head>

<body>
    @include('layout.navbar')
    <div class="app-wrapper">
        <div class="app-container">
            <div class="main-content">
                @yield('content')
            </div>
            <div class="side-bar">
                <div class="breaking">
                    <h3>Breaking News</h3>
                    @if(count($breaking) > 0)
                    @foreach($breaking as $breaking_article)
                    <div class="card mb-3" style="max-width: 540px;">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src={{$breaking_article['img_url']}} class="img-fluid" alt="...">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title"><a href="{{route('article.show',$breaking_article->id)}}">{{$breaking_article['title']}}</a></h5>
                                    <p class="card-text">{{$breaking_article['description']}}</p>
                                    <p class="card-text"><small class="text-muted">{{$breaking_article['published_at']->isoFormat('MMMM Do YYYY, h:mm:ss a')}}</small></p>
                                </div>
                            </div>
                        </div>
                        <div class="card-banner" style="background:{{$breaking_article['color']}};">
                            <p>{{$breaking_article->breaking_text??'Breaking News'}}</p>
                        </div>
                    </div>
                    @endforeach
                    @else
                    <p>No Breaking News</p>
                    @endif
                </div>
                <div class="categories">
                    <h3>Categories</h3>
                    <ul class="list-group">
                        @foreach($category as $cat)
                        @php
                        $active = $cat_id == $cat->id ? 'active':''
                        @endphp
                        <a href="{{route('article.index',['cat_id'=>$cat->id])}}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center {{$active}}" aria-current="true">
                            {{ $cat->title}}
                            <span class="badge bg-primary rounded-pill">{{$cat->articles->count()}}</span>
                        </a>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</body>
<footer>
    <div class="py-5 px-2 bg-light h-25">
        @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
        @endif
        <h3 class="">Subscribe to our newsletter</h3>
        <p class="">Never miss what's happening around the world!</p>
        <form class="row g-3" action="{{url('news-letter')}}" method="post">
            @csrf
            <div class="col-md-6 col-sm-12">
                <label for="inputPassword2" class="visually-hidden">Email</label>
                <input type="email" name="mail" class="form-control" id="inputPassword2" required placeholder="Email">
            </div>
            <div class="col-md-6 col-sm-12">
                <button type="submit" class="btn btn-primary mb-3">Subscribe</button>
            </div>
        </form>
    </div>
</footer>

</html>