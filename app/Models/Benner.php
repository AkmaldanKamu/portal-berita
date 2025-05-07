<?php

namespace App\Models;

use App\Models\News;
use Illuminate\Database\Eloquent\Model;

class Benner extends Model
{
    protected $fillable = [
        'news_id',
    ];

    public function news()
    {
        return $this->belongsTo(News::class);
    }
}
