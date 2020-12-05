<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\RoomController;
use App\Http\Controllers\Api\ReservationController;
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
    Route::get('rooms/{roomId}', [RoomController::class, 'view'])->where('roomId', '[0-9]+');
    Route::delete('rooms/{roomId}', [RoomController::class, 'destroy'])->where('roomId', '[0-9]+');
    Route::patch('rooms/{roomId}', [RoomController::class, 'update'])->where('roomId', '[0-9]+');
    Route::post('rooms', [RoomController::class, 'create']);

    Route::get('rooms/{roomId}/reservation', [RoomController::class, 'getRevelation'])->where('roomId', '[0-9]+');

    Route::get('reservation', [ReservationController::class, 'index']);
    Route::get('reservation/{reservationId}', [ReservationController::class, 'view'])->where('reservationId', '[0-9]+');
    Route::get('reservation/{reservationId}/room', [ReservationController::class, 'getRoom'])->where('reservationId', '[0-9]+');
    Route::delete('reservation/{reservationId}', [ReservationController::class, 'destroy'])->where('reservationId', '[0-9]+');
    Route::patch('reservation/{reservationId}', [ReservationController::class, 'update'])->where('reservationId', '[0-9]+');
    Route::post('rooms/{roomId}/reservation', [ReservationController::class, 'create'])->where('roomId', '[0-9]+');

    Route::get('user', function (Request $request) {
        return $request->user();
    });
});