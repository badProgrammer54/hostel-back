<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\News\CategoryController;
use App\Http\Controllers\Api\News\PostController;
use App\Http\Controllers\Api\RoomController;
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
    Route::get('rooms', [RoomController::class, 'index']);
    Route::get('rooms/{roomId}', [RoomController::class, 'view'])->where('id', '[0-9]+');
    Route::delete('rooms/{roomId}', [RoomController::class, 'destroy'])->where('id', '[0-9]+');
    Route::patch('rooms/{roomId}', [RoomController::class, 'update'])->where('id', '[0-9]+');
    Route::post('rooms', [RoomController::class, 'create']);

    Route::get('user', function (Request $request) {
        return $request->user();
    });
});