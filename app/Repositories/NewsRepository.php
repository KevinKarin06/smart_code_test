<?php

namespace App\Repositories;

use App\Functions;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class NewsRepository
{
    private LocalNewsRepository $local;
    private RemoteNewsRepository $remote;
    public function __construct(LocalNewsRepository $localNewsRepository, RemoteNewsRepository $remoteNewsRepository)
    {
        $this->local = $localNewsRepository;
        $this->remote = $remoteNewsRepository;
    }

    public function getAll()
    {
        $remoteArticles =  $this->remote->getAll();
        return $remoteArticles->merge($this->local->getAll());
    }

    public function get($id)
    {
        $article = $this->local->get($id);
        if (!$article) {
            $article = $this->remote->get($id);
            return $article;
        } else return $article;
    }

    public function create(Request $request, $id = null)
    {
        $resp = null;
        DB::beginTransaction();
        try {
            $validated = Validator::make($request->all(), [
                "source_id" => 'nullable',
                "source_name" => 'nullable',
                "author" => 'nullable',
                "title" => 'required',
                "url" => 'nullable',
                "img" => 'required|file',
                "description" => 'required',
                "content" => 'required',
                "category" => 'nullable',
                "breaking" => 'nullable',
                "banner_text" => 'nullable',
                "color" => 'nullable'
            ]);
            if ($validated->fails()) return $validated->errors();
            $imgPath = Functions::storeFile($request->file('img'));
            $data = [
                'source_id' => $request->source_id,
                'source_name' => $request->source_name,
                'author' => $request->author ?? $request->user()->name,
                'title' => $request->title,
                'url' => $request->url,
                'img_url' => $imgPath,
                'description' => $request->description,
                'content' => $request->content,
                'published_at' => now(),
                "category" => $request->category,
                "breaking" => $request->breaking,
                "breaking_text" => $request->banner_text,
                "color" => $request->color ?? '#eb1515'
            ];
            $resp = $this->local->create($data, $id);
            DB::commit();
        } catch (Exception $e) {
            dd($e);
            Functions::deleteFile($imgPath);
            $resp['error'] = $e->getMessage();
            DB::rollBack();
        }
        return $resp;
    }

    public function update(Request $request, $id)
    {
        $resp = null;
        DB::beginTransaction();
        try {
            $validated = Validator::make($request->all(), [
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
            if ($validated->fails()) return $validated->errors();
            if ($request->hasFile('img')) {
                $imgPath = Functions::storeFile($request->file('img'));
            } else {
                $imgPath = null;
            }
            $data = [
                'source_id' => $request->source_id,
                'source_name' => $request->source_name,
                'author' => $request->author ?? $request->user()->name,
                'title' => $request->title,
                'url' => $request->url,
                'img_url' => $imgPath,
                'description' => $request->description,
                'content' => $request->content,
                'published_at' => now(),
                "category" => $request->category,
                "breaking" => $request->breaking,
                "breaking_text" => $request->banner_text,
                "color" => $request->color
            ];
            $resp = $this->local->update($id, $data);
            DB::commit();
        } catch (Exception $e) {
            dd($e);
            Functions::deleteFile($imgPath);
            $resp['error'] = $e->getMessage();
            DB::rollBack();
        }
        return $resp;
    }

    public function delete(int $id)
    {
        return $this->local->delete($id);
    }
}
