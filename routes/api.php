<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\Image\UploadController;
use App\Http\Controllers\Api\v1\SearchController;

Route::post('/image/upload', [UploadController::class, 'store']);

Route::get('/search', [SearchController::class, 'search']);

Route::group(['prefix' => 'users'], function() {
	require base_path('routes/api/v1/user.php');
});

Route::group(['prefix' => 'articles'], function() {
	require base_path('routes/api/v1/article.php');
});

Route::group(['prefix' => 'threads'], function() {
	require base_path('routes/api/v1/thread.php');
});

Route::group(['prefix' => 'auth'], function() {
	require base_path('routes/api/v1/auth.php');
});
