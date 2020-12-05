<?php


namespace App\Repositories;


use App\Models\Cost;

class CostRepository extends BaseRepository
{
    /** @return string */
    public function getModelClass(): string
    {
        return Cost::class;
    }
}