<?php

namespace App\Http\Requests\News;

use App\Http\Requests\BaseRequest;
use App\Models\NewsPost;

class PostUpdateRequest extends BaseRequest
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

    public function getDataUpdate(): array
    {
        $result = [];
        $fillables = (new NewsPost())->getFillable();
        foreach ($fillables as $fillable)
        {
            if($this->get($fillable) !== null) {
                $result[$fillable] = $this->get($fillable);
            }
        }
        return $result;
    }
}
