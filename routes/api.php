<?php

use App\Http\Controllers\Api\V1\ForumController;
use App\Http\Controllers\Api\V1\HomeController;
use App\Http\Controllers\Api\V1\LifeController;
use App\Http\Controllers\Api\V1\PathsController;
use App\Http\Controllers\Api\V1\StudiesController;
use App\Http\Controllers\Api\V1\TestsController;
use App\Http\Controllers\Api\V1\WorksController;
use Illuminate\Support\Facades\Route;

Route::post('register', [\App\Http\Controllers\AuthController::class, 'register']);
Route::post('login', [\App\Http\Controllers\AuthController::class, 'login']);
Route::middleware('auth:sanctum')->get('me', [\App\Http\Controllers\AuthController::class, 'me']);

Route::prefix('v1')->group(function () {
    // PUBLIC
    Route::get('home', [HomeController::class, 'index']);
    Route::get('life', [LifeController::class, 'index']);
    Route::get('life/{slug}', [LifeController::class, 'show']);
    Route::get('works', [WorksController::class, 'index']);
    Route::get('paths', [PathsController::class, 'index']);
    Route::get('studies', [StudiesController::class, 'index']);
    Route::get('tests', [TestsController::class, 'index']);
    Route::get('tests/{id}', [TestsController::class, 'show']);
    Route::get('forum/categories', [ForumController::class, 'categories']);
    Route::get('forum/topics', [ForumController::class, 'index']);
    Route::get('forum/topics/{id}', [ForumController::class, 'show']);
    Route::get('forum/topics/{id}/replies', [ForumController::class, 'replies']);

    // PROTECTED
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('tests/{id}/submit', [TestsController::class, 'submit'])
            ->middleware('role:student,admin');

        // Forum Protected Routes
        Route::post('forum/topics', [ForumController::class, 'store']);
        Route::post('forum/topics/{id}/replies', [ForumController::class, 'storeReply']);
        Route::post('forum/interactions/like', [ForumController::class, 'like']);
        Route::post('forum/interactions/bookmark', [ForumController::class, 'bookmark']);
    });
});
