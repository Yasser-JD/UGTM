<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\CategoryController;

use App\Http\Controllers\Api\AuthController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::get('/search', [App\Http\Controllers\Api\SearchController::class, 'index']);
Route::get('/provinces', [App\Http\Controllers\Api\LocationController::class, 'getProvinces']);
Route::get('/communes', [App\Http\Controllers\Api\LocationController::class, 'getCommunes']);
Route::get('/schools', [App\Http\Controllers\Api\LocationController::class, 'getSchools']);
Route::post('/contact', [App\Http\Controllers\Api\ContactController::class, 'store']);
Route::post('/complaints', [App\Http\Controllers\Api\ComplaintController::class, 'store'])->middleware('auth:sanctum');
Route::get('/complaints', [App\Http\Controllers\Api\ComplaintController::class, 'index'])->middleware('auth:sanctum');

Route::name('api.')->group(function () {
    Route::apiResource('posts', PostController::class)->only(['index', 'show']);
    Route::apiResource('categories', CategoryController::class)->only(['index']);
});
