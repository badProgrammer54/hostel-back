<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\News\PostController;
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
});

Route::prefix('news')->middleware('auth:sanctum')->group(function () {
    Route::get('posts', [PostController::class, 'index'])->name('news.posts');
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});