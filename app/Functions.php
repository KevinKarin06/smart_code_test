<?php

namespace App;

use Illuminate\Support\Facades\Storage;

class Functions
{

    public static function storeFile($file)
    {
        $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs('article_img', $fileName, 'public');
        return $path;
    }

    public static function deleteFile(string $path)
    {
        Storage::disk('public')->delete($path);
    }
}
