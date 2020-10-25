<?php


namespace App\Services\News;


use App\Repositories\NewsCategoryRepository;
use App\Repositories\NewsPostRepository;

trait NewsTrait
{
    /** @var NewsPostRepository */
    private $newsPostRepository;

    /** @var NewsCategoryRepository */
    private $newsCategoryRepository;

    public function __construct(NewsPostRepository $newsPostRepository, NewsCategoryRepository $newsCategoryRepository)
    {
        $this->newsPostRepository = $newsPostRepository;
        $this->newsCategoryRepository = $newsCategoryRepository;
    }

    public function getNewsPostRepository(): NewsPostRepository
    {
        return $this->newsPostRepository;
    }

    public function getNewsCategoryRepository(): NewsCategoryRepository
    {
        return $this->newsCategoryRepository;
    }
}