<?php

namespace App\Http\Controllers\Api\News;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\News\PostStoreRequest;
use App\Models\NewsPost;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PostController extends ApiController
{
    private const COUNT_POSTS_TO_PAGINATE = 15;

    public function index(): JsonResponse
    {
        $newsPosts = NewsPost::paginate(self::COUNT_POSTS_TO_PAGINATE);
        return $this->sendResponse(['news_posts' => $newsPosts]);
    }


    public function store(PostStoreRequest $request): JsonResponse
    {
        $newsPost = NewsPost::create([
            'category_id' => $request->getCategoryId(),
            'user_id' => $request->getUserId(),
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
        $newsPost = NewsPost::where('id', $id)->first();
        return $this->sendResponse(['news_post' => $newsPost]);

    }

    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
