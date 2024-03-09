<?php

namespace App\Domain\Posts\Models;

use App\Domain\Categories\Models\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    public $guarded = [];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
