<?php

namespace App\Models;

use App\Models\Author;
use App\Models\Benner;
use App\Models\NewsCategory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $fillable = [
        'author_id',
        'news_category_id',
        'title',
        'slug',
        'thumbnail',
        'content',
    ];

    public function author()
    {
        return $this->belongsTo(Author::class);
    }
    
    public function newsCategory()
    {
        return $this->belongsTo(NewsCategory::class);
    }

    public function benner()
    {
        return $this->hasOne(Benner::class);
    }

}

