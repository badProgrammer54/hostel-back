<?php


namespace App\Repositories;



use App\Models\NewsCategory;

class NewsCategoryRepository extends BaseRepository
{
    /** @return string */
    public function getModelClass(): string
    {
        return NewsCategory::class;
    }
}