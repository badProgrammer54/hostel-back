<?php

namespace App\Http\Requests\News;

use App\Http\Requests\BaseRequest;

class PostStoreRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'category_id' => ['integer', 'required'],
            'title' => ['string', 'max:255', 'required'],
            'slug' => ['string', 'max:255', 'required', 'unique:news_posts'],
            'excerpt' => ['string', 'max:2048', 'required'],
            'content_raw' => ['string', 'max:4048', 'required'],
            'content_html' => ['string', 'max:4048', 'required'],
            'is_published' => ['boolean', 'required'],
        ];
    }

    public function getIsPublished(): bool
    {
        return $this->get('is_published');
    }

    public function getContentHtml(): string
    {
        return $this->get('content_html');
    }

    public function getContentRaw(): string
    {
        return $this->get('content_raw');
    }

    public function getExcerpt(): string
    {
        return $this->get('excerpt');
    }

    public function getSlug(): string
    {
        return $this->get('slug');
    }

    public function getTitle(): string
    {
        return $this->get('title');
    }

    public function getCategoryId(): int
    {
        return $this->get('category_id');
    }
}
