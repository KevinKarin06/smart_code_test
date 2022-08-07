<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class Article extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = ['breaking' => 'boolean', 'published_at' => 'datetime'];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    // protected function imgUrl(): Attribute
    // {
    //     return Attribute::make(
    //         get: fn ($value) => isset($this->id) ? Storage::url($value) : $value,
    //     );
    // }

}
