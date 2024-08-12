<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'release_date', 'duration', 'categories_id', 'author_id', 'image_path'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'categories_id');
    }
}
