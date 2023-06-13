<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @mixin IdeHelperPost
 */
class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug', 'content', 'category_id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}