<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\Articles\GetArticleController;
use App\Http\Controllers\Api\v1\Articles\EditArticleController;
use App\Http\Controllers\Api\v1\Articles\ShowArticleController;
use App\Http\Controllers\Api\v1\Articles\CreateArticleController;
use App\Http\Controllers\Api\v1\Articles\DeleteArticleController;

Route::get('/all', [GetArticleController::class, 'index']);
Route::post('/create', [CreateArticleController::class, 'store']);
Route::delete('/delete/{article}', [DeleteArticleController::class, 'delete']);
Route::patch('/edit/{article}', [EditArticleController::class, 'edit']);
Route::get('/{article}', [ShowArticleController::class, 'show']);