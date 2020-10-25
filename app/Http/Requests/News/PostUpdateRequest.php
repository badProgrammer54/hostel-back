<?php

namespace App\Http\Requests\News;

use App\Http\Requests\BaseRequest;
use App\Interfaces\DataUpdateNewsPostInterface;

class PostUpdateRequest extends BaseRequest implements DataUpdateNewsPostInterface
{
    public function rules(): array
    {
        return [
            'category_id' => ['integer'],
            'user_id' => ['integer'],
            'title' => ['string', 'max:255'],
            'slug' => ['string', 'max:255', 'unique:news_posts'],
            'excerpt' => ['string', 'max:2048'],
            'content_raw' => ['string', 'max:4048'],
            'content_html' => ['string', 'max:4048'],
            'is_published' => ['boolean'],
        ];
    }

    public function getIsPublished(): bool
    {
        return $this->get('is_published') ?: false;
    }

    public function getCategoryId(): ?int
    {
        return $this->get('category_id');
    }

    public function getDataToUpdate(): array
    {
        return $this->all() ?: [];
    }
}
