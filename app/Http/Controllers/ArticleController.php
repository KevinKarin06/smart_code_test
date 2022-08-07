<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Repositories\NewsRepository;
use Illuminate\Http\Request;

class ArticleController extends Controller
{

    private NewsRepository $repository;

    public function __construct(NewsRepository $newsRepository)
    {
        $this->repository = $newsRepository;
        $this->middleware('auth')->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $cats = $request->query();
        if ($cats != null && isset($cats['cat_id'])) {
            if (count($cats) > 0) {
                $cat = Category::find($cats['cat_id']);
                // dd($cat);
                $articles = $cat->articles->sortByDesc('published_at')->paginate(4);
                return view('index', ['data' => $articles, 'cat_id' => $cats['cat_id']]);
            }
        }
        $res = $this->repository->getAll()->sortByDesc('published_at')->paginate(4);
       
        return view('index', ['data' => $res, 'cat_id' => -1]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.create_article');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "source_id" => 'nullable',
            "source_name" => 'nullable',
            "author" => 'nullable',
            "title" => 'required',
            "url" => 'nullable',
            "img" => 'required',
            "description" => 'required',
            "content" => 'required',
            "category" => 'nullable',
            "breaking" => 'nullable',
            "banner_text" => 'nullable',
            "color" => 'nullable'
        ]);
        $request->breaking = $request->breaking == 'on' ? true : false;

        $val = $this->repository->create($request);
        return back()->with('article-created', 'Article Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = $this->repository->get($id);
        return view('article_detail', ['article' => $article, 'cat_id' => -1]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = $this->repository->get($id);
        return view('admin.edit_article', ['article' => $article]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            "source_id" => 'nullable',
            "source_name" => 'nullable',
            "author" => 'nullable',
            "title" => 'required',
            "url" => 'nullable',
            "img" => 'nullable',
            "description" => 'required',
            "content" => 'required',
            "category" => 'nullable',
            "breaking" => 'nullable',
            "banner_text" => 'nullable',
            "color" => 'nullable'
        ]);
        $request->breaking = $request->breaking == 'on' ? true : false;

        $val = $this->repository->update($request, $id);
        return back()->with('article-updated', 'Article Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->middleware('auth');
        $article = Article::find($id);
        $article->delete();
        return back()->with('article-deleted', 'Article Deleted');
    }
}
