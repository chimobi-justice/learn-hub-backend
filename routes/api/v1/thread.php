<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\Threads\CreateThreadsController;
use App\Http\Controllers\Api\v1\Threads\EditThreadsController;
use App\Http\Controllers\Api\v1\Threads\ShowThreadController;
use App\Http\Controllers\Api\v1\Threads\DeleteThreadsController;
use App\Http\Controllers\Api\v1\Threads\GetThreadsController;
use App\Http\Controllers\Api\v1\Threads\AuthoredThreadsController;
use App\Http\Controllers\Api\v1\Threads\ThreadCommentController;
use App\Http\Controllers\Api\v1\Threads\ThreadLikeController;

Route::group(['middleware' => 'auth:api'], function() {       
    Route::post('/create', [CreateThreadsController::class, 'store']);
    Route::delete('/delete/{thread}', [DeleteThreadsController::class, 'delete']);
    Route::patch('/edit/{thread}', [EditThreadsController::class, 'edit']);
    Route::get('/authored/{username}', [AuthoredThreadsController::class, 'getAuthoredThreads']);
    Route::post('/{thread}/comments', [ThreadCommentController::class, 'store']);
    Route::patch('/{thread}/comments', [ThreadCommentController::class, 'edit']);

    Route::delete('/comments/{threadComment}', [ThreadCommentController::class, 'destroy']);
    Route::post('/{threadLike}/likes', [ThreadLikeController::class, 'store']);
    Route::delete('/{threadLike}/dislikes', [ThreadLikeController::class, 'destroy']);
});

Route::get('/all', [GetThreadsController::class, 'getAllThreads']);
Route::get('/all/paginate', [GetThreadsController::class, 'getPaginatedThreads']);
Route::get('/{thread}', [ShowThreadController::class, 'show']);
Route::get('/authored/{username}/public', [AuthoredThreadsController::class, 'getPublicAuthoredThreads']);