<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PostCategory extends Model
{
    use HasFactory;
    protected $fillable = ['category_name','parent_category'];

    public function posts(): BelongsToMany
    {
        return $this->belongsToMany(Post::class, 'posts_post_categories','post_categories_id','posts_id');
    }
    public function parentCategory(): BelongsTo
    {
        return $this->belongsTo(PostCategory::class,'parent_category');
    }
}
