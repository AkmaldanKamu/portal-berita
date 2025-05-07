<?php

namespace App\Models;

use App\Models\News;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $fillable = [
        'name',
        'username',
        'avatar',
        'bio',
    ];

    public function news()
    {
        return $this->hasMany(News::class);
    }

}
