<?php

namespace App\Models;


class NewsPost extends BaseModel
{
    protected $fillable = [
        'category_id',
        'user_id',
        'title',
        'slug',
        'excerpt',
        'content_raw',
        'content_html',
        'is_published',
        'published_at'
    ];

    public function getIsPublished(): bool
    {
        return $this->is_published;
    }

    public function getFillables(): array
    {
        return $this->fillable;
    }
}
