<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'body',
        'category_id',
        'author_id',
        'thumbnail_url',
        'read_time',
        'status',
        'published_at',
        'meta_title',
        'meta_description',
        'featured',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'featured' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published')
                     ->whereNotNull('published_at')
                     ->where('published_at', '<=', now());
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getThumbClassAttribute(): string
    {
        return 'img-ph-' . (($this->id % 5) + 1);
    }
}
