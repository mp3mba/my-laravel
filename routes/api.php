<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RatingController;

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

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/rate-product', [RatingController::class, 'rateProduct']);
    Route::delete('/remove-rating', [RatingController::class, 'removeRating']);
    Route::put('/change-rating', [RatingController::class, 'changeRating']);
});
