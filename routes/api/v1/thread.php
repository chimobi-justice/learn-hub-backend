<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\Threads\CreateThreadsController;
use App\Http\Controllers\Api\v1\Threads\EditThreadsController;
use App\Http\Controllers\Api\v1\Threads\ShowThreadController;
use App\Http\Controllers\Api\v1\Threads\DeleteThreadsController;
use App\Http\Controllers\Api\v1\Threads\GetThreadsController;
use App\Http\Controllers\Api\v1\Threads\AuthoredThreadsController;


Route::group(['middleware' => 'auth:api'], function() {       
    Route::post('/create', [CreateThreadsController::class, 'store']);
    Route::delete('/delete/{thread}', [DeleteThreadsController::class, 'delete']);
    Route::patch('/edit/{thread}', [EditThreadsController::class, 'edit']);
    Route::get('/authored', [AuthoredThreadsController::class, 'getAuthoredThreads']);
});

Route::get('/all', [GetThreadsController::class, 'getAllThreads']);
Route::get('/all/paginate', [GetThreadsController::class, 'getPaginatedThreads']);
Route::get('/{thread}', [ShowThreadController::class, 'show']);