<?php

namespace App\Repositories;

use App\Interfaces\INewsInterface;
use App\Models\Article;

class LocalNewsRepository implements INewsInterface
{
    public function getAll()
    {
        return Article::where('breaking', false)->get();
    }

    public function getBreaking()
    {
        return Article::where('breaking', true)->get();
    }

    public function get($id)
    {
        return Article::find($id);
    }

    public function update($id, $data)
    {
        $article = Article::find($id);

        $category = $data['category'];
        if ($data['img_url'] == null) {
            unset($data['img_url']);
        }
        unset($data['category']);

        $article->fill($data);
        $article->save();

        if (isset($category) && count($category) > 0) {
            $article->categories()->sync($category);
        } else {
            $article->categories()->sync([]);
        }
        return $article;
    }

    public function create($data, $id = null)
    {
        $category = $data['category'];
        unset($data['category']);
        $datas = $data;
        $article = Article::updateOrCreate(['id' => $id], $datas);

        if (isset($category) && count($category) > 0) {
            $article->categories()->attach($category);
        }
        return $article;
    }
    public function delete(int $id)
    {
        $article = Article::find($id);

        $article->categories()->detach();

        $article->delete();
    }
}
