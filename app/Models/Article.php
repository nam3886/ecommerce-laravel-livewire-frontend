<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'author_id',
        'slug',
        'title',
        'thumbnail',
        'description',
        'content',
        'frontend_type',
        'active',
        'updated_by',
    ];

    public function author(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'author_id');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    public function getThumbnailAttribute($value)
    {
        return match ($this->frontend_type) {
            'image'     => $value,
            'slider'    => json_decode($value),
            'video'     => json_decode($value),
            'audio'     => $value,
        };
    }
}
