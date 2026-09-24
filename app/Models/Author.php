<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'role',
        'specialty',
        'qualifications',
        'experience_years',
        'initials',
        'avatar_url',
        'bio',
        'education',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getInitialsAttribute(): string
    {
        if (!empty($this->attributes['initials'])) {
            return $this->attributes['initials'];
        }
        $words = array_filter(explode(' ', $this->attributes['name'] ?? ''));
        return strtoupper(implode('', array_map(fn ($w) => $w[0], $words)));
    }
}
