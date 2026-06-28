<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'subject',
        'type',
        'body',
        'read',
        'received_at',
    ];

    protected $casts = [
        'read' => 'boolean',
        'received_at' => 'datetime',
    ];

    public function getPreviewAttribute(): string
    {
        return \Illuminate\Support\Str::limit(strip_tags($this->body ?? ''), 120);
    }
}
