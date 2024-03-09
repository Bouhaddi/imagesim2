<?php

namespace App\Domain\Categories\Models;

use App\Domain\Posts\Models\Post;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public $guarded = [];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
