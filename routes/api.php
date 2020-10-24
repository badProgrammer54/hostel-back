<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\News\CategoryController;
use App\Http\Controllers\Api\News\PostController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['prefix' => 'auth'], function () {
    Route::post('/sign-in', [AuthController::class, 'signIn']);
    Route::post('/sign-up', [AuthController::class, 'signUp']);
});



Route::middleware(['auth:sanctum'])->group(function () {
    Route::prefix('news')->group(function () {
        Route::get('posts', [PostController::class, 'index']);
        Route::get('posts/{id}', [PostController::class, 'show'])->where('id', '[0-9]+');
        Route::post('posts', [PostController::class, 'store']);
        Route::patch('posts/{id}', [PostController::class, 'update'])->where('id', '[0-9]+');
        Route::delete('posts/{id}', [PostController::class, 'destroy'])->where('id', '[0-9]+');

        Route::get('categories', [CategoryController::class, 'index']);
        Route::get('categories/{id}', [CategoryController::class, 'show'])->where('id', '[0-9]+');
        Route::post('categories', [CategoryController::class, 'store']);
        Route::patch('categories/{id}', [CategoryController::class, 'update'])->where('id', '[0-9]+');
        Route::delete('categories/{id}', [CategoryController::class, 'destroy'])->where('id', '[0-9]+');

    });

    Route::get('user', function (Request $request) {
        return $request->user();
    });
});