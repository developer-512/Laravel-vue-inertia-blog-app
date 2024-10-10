<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Post extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'body'];

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(PostCategory::class, 'posts_post_categories','posts_id','post_categories_id');
    }
}
