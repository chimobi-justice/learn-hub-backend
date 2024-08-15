<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\Articles\GetArticleController;
use App\Http\Controllers\Api\v1\Articles\EditArticleController;
use App\Http\Controllers\Api\v1\Articles\ShowArticleController;
use App\Http\Controllers\Api\v1\Articles\CreateArticleController;
use App\Http\Controllers\Api\v1\Articles\DeleteArticleController;
use App\Http\Controllers\Api\v1\Articles\GetNewArticleController;

Route::group(['middleware' => 'auth:api'], function() {       
    Route::post('/create', [CreateArticleController::class, 'store']);
    Route::delete('/delete/{article}', [DeleteArticleController::class, 'delete']);
    Route::patch('/edit/{article}', [EditArticleController::class, 'edit']);
});

Route::get('/all', [GetArticleController::class, 'index']);
Route::get('/all/new', [GetNewArticleController::class, 'index']);
Route::get('/{slug}', [ShowArticleController::class, 'show']);