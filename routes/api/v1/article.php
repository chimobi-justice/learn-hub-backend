<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\Articles\GetArticleController;
use App\Http\Controllers\Api\v1\Articles\EditArticleController;
use App\Http\Controllers\Api\v1\Articles\ShowArticleController;
use App\Http\Controllers\Api\v1\Articles\CreateArticleController;
use App\Http\Controllers\Api\v1\Articles\DeleteArticleController;
use App\Http\Controllers\Api\v1\Articles\AuthoredArticlesController;
use App\Http\Controllers\Api\v1\Articles\ArticleLikeController; 
use App\Http\Controllers\Api\v1\Articles\ArticleCommentController; 
use App\Http\Controllers\Api\v1\Articles\RecommendedArticlesController; 
use App\Http\Controllers\Api\v1\Articles\PinnedArticlesController; 
use App\Http\Controllers\Api\v1\Articles\SavedUnsavedArticleController; 

Route::group(['middleware' => 'auth:api'], function() {       
    Route::post('/create', [CreateArticleController::class, 'store']);
    Route::delete('/delete/{article}', [DeleteArticleController::class, 'delete']);
    Route::patch('/edit/{article}', [EditArticleController::class, 'edit']);
    Route::get('/authored/{username}', [AuthoredArticlesController::class, 'getAuthoredArticles']);
    Route::delete('/comments/{articleComment}', [ArticleCommentController::class, 'destroy']);

    Route::post('/{article}/comments', [ArticleCommentController::class, 'store']);
    Route::patch('/{article}/comments', [ArticleCommentController::class, 'edit']);

    Route::post('/{article}/likes', [ArticleLikeController::class, 'store']);
    Route::delete('/{article}/dislikes', [ArticleLikeController::class, 'destroy']);

    Route::get('/recommented-articles', [RecommendedArticlesController::class, 'getRecommentedArticles']);

    Route::post('/save-article/{article}', [SavedUnsavedArticleController::class, 'saveArticle']);
    Route::delete('/unsave-article/{article}', [SavedUnsavedArticleController::class, 'unsaveArticle']);
    Route::get('/saved-articles', [SavedUnsavedArticleController::class, 'getSavedArticles']);
});

Route::get('/pinned-articles', [PinnedArticlesController::class, 'pinnedArticles']);
Route::get('/all', [GetArticleController::class, 'getAllArticles']);
Route::get('/all/paginate', [GetArticleController::class, 'getPaginatedArticles']);
Route::get('/{article}/arthored-related-articles', [ShowArticleController::class, 'getArthorArticle']);
Route::get('/{article}', [ShowArticleController::class, 'show']);
Route::get('/authored/{username}/public', [AuthoredArticlesController::class, 'getPublicAuthoredArticles']);
