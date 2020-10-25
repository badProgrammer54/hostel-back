<?php


namespace App\Repositories;


use App\Models\NewsPost;


class NewsPostRepository extends BaseRepository
{
    /** @return string */
    public function getModelClass(): string
    {
        return NewsPost::class;
    }
}