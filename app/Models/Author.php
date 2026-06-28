<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'role',
        'initials',
        'avatar_url',
        'bio',
    ];

    public function articles()
    {
        return $this->hasMany(Article::class);
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
