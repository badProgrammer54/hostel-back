<?php

namespace App\Http\Controllers\Api\News;

use App\Http\Controllers\Api\ApiController;
use App\Models\NewsCategory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryController extends ApiController
{
    public function index(): JsonResponse
    {
        return $this->sendResponse(['news_category' => NewsCategory::all()]);
    }

    public function store(Request $request): JsonResponse
    {
        //
    }

    public function show(int $id): JsonResponse
    {
        $newsCategory = NewsCategory::find($id);
        return $this->sendResponse(['news_category' => $newsCategory]);
    }

    public function update(Request $request,int $id): JsonResponse
    {
        //
    }

    public function destroy(int $id): JsonResponse
    {
        //
    }
}
