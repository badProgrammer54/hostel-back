<?php

namespace App\Http\Controllers\Api\News;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\News\PostStoreRequest;
use App\Http\Requests\News\PostUpdateRequest;
use App\Models\NewsCategory;
use App\Models\NewsPost;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PostController extends ApiController
{
    private const COUNT_POSTS_TO_PAGINATE = 15;
    private const FIELDS_UPDATE = [
        'category_id',
        'title',
        'slug',
        'excerpt',
        'content_raw',
        'content_html',
        'is_published',
        'published_at'
    ];

    public function index(): JsonResponse
    {
        $newsPosts = NewsPost::paginate(self::COUNT_POSTS_TO_PAGINATE);
        return $this->sendResponse(['news_posts' => $newsPosts]);
    }


    public function store(PostStoreRequest $request): JsonResponse
    {
        $newsCategory = NewsCategory::find($request->getCategoryId());

        if (!($newsCategory instanceof NewsCategory)) {
            return $this->sendError(1, 'Category with ' . $request->getCategoryId() . ' not found', 404);
        }

        $newsPost = NewsPost::create([
            'category_id' => $request->getCategoryId(),
            'user_id' => $request->user()->id,
            'title' => $request->getTitle(),
            'slug' => $request->getSlug(),
            'excerpt' => $request->getExcerpt(),
            'content_raw' => $request->getContentRaw(),
            'content_html' => $request->getContentHtml(),
            'is_published' => $request->getIsPublished(),
            'published_at' => $request->getIsPublished() ? date("Y-m-d H:i:s") : null,
        ]);

        $newsPost->save();

        return $this->sendResponse(['news_post' => $newsPost]);
    }

    public function show(int $id): JsonResponse
    {
        $newsPost = NewsPost::find($id);

        return $this->sendResponse(['news_post' => $newsPost]);
    }

    public function update(PostUpdateRequest $request, int $id): JsonResponse
    {
        $dataPublished = [];
        $newsCategoryId = $request->getCategoryId();

        $newsPost = NewsPost::find($id);
        if (!($newsPost instanceof NewsPost)) {
            return $this->sendError(1, 'Post with ' . $id . ' not found', 404);
        }

        if ($newsCategoryId !== null && NewsCategory::find($newsCategoryId) instanceof NewsCategory) {
            return $this->sendError(1, 'Category with ' . $request->getCategoryId() . ' not found', 404);
        }

        if (!$newsPost->getIsPublished() && $request->getIsPublished()) {
            $dataPublished = ['published_at' => date("Y-m-d H:i:s")];

        }
        $newsPost->update(array_merge($this->getValidDataToNewsPost($request), $dataPublished));

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

    private function getValidDataToNewsPost(Request $request): array
    {
        $result = [];
        foreach (self::FIELDS_UPDATE as $field) {
            if ($request->get($field) !== null) {
                $result[$field] = $request->get($field);
            }
        }
        return $result;
    }
}
