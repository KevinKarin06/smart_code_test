<?php

namespace App\Repositories;

use App\Interfaces\INewsInterface;
use App\Models\Article;
use Exception;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class RemoteNewsRepository implements INewsInterface
{
    private string $url = "https://newsapi.org/v2/everything?q=tech&apiKey=4586a1c816a54ee7a85636e16b6a0d09";

    public function getAll()
    {
        $json = null;
        try {
            $response = Http::get($this->url);
            $json =  $response->json();
        } catch (Exception $ex) {
            $value = Cache::get('remote_articles', collect([]));
            return $value;
        }
        $models = [];
        foreach ($json['articles'] as $article) {
            $data = [
                'source_id' => $article['source']['id'],
                'source_name' => $article['source']['name'],
                'author' => $article['author'],
                'title' => $article['title'],
                'url' => $article['url'],
                'img_url' => $article['urlToImage'],
                'description' => $article['description'],
                'content' => $article['content'],
                'published_at' => $article['publishedAt'],
            ];
            $model = new Article($data);
            array_push($models, $model);
        }

        $articleCollection = collect($models);
        Cache::put('remote_articles', $articleCollection, now()->addMinutes(30));
        return $articleCollection;
    }

    public function get($id)
    {
        $value = Cache::get('remote_articles', collect([]));
        $article = $value->where('title', $id)->values()->all();
        if (count($article) > 0) {
            return $article[0];
        }
    }
}
