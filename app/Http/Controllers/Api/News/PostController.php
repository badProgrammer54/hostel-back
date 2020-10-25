<?php

namespace App\Http\Controllers\Api\News;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\News\PostStoreRequest;
use App\Http\Requests\News\PostUpdateRequest;
use App\Models\Exceptions\BaseException;
use App\Models\NewsPost;
use App\Services\News\PostService;
use Exception;
use Illuminate\Http\JsonResponse;

class PostController extends ApiController
{
    private const COUNT_POSTS_TO_PAGINATE = 15;

    private $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function index(): JsonResponse
    {
        $newsPosts = NewsPost::paginate(self::COUNT_POSTS_TO_PAGINATE);
        return $this->sendResponse(['news_posts' => $newsPosts]);
    }


    public function store(PostStoreRequest $request): JsonResponse
    {
        try {
            $newsPost = $this->postService->createNewsPost($request);
        } catch (BaseException $e) {
            return $this->sendError(1, $e->getMessage(), $e->getCode());
        }

        return $this->sendResponse(['news_post' => $newsPost]);
    }

    public function show(int $id): JsonResponse
    {
        $newsPost = NewsPost::find($id);

        return $this->sendResponse(['news_post' => $newsPost]);
    }

    public function update(PostUpdateRequest $request, int $id): JsonResponse
    {
        try {
            $newsPost = $this->postService->updateNewsPost($id, $request);
        } catch (BaseException $e) {
            return $this->sendError(1, $e->getMessage(), $e->getCode());
        }

        return $this->sendResponse(['news_post' => $newsPost]);
    }


    public function destroy(int $id): JsonResponse
    {
        $newsPost = NewsPost::find($id);
        if (!($newsPost instanceof NewsPost)) {
            return $this->sendError(1, 'Post with ' . $id . ' not found', 404);
        }

        try {
            $newsPost->delete();
        } catch (Exception $e) {
            return $this->sendError(1, $e->getMessage(), 404);
        }

        return $this->sendResponse([]);
    }
}
