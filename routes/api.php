<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\Image\UploadController;

// Route::group(['middleware' => 'auth:api'], function() {
	
// 	Route::group(['prefix' => 'users'], function() {
// 		require base_path('routes/api/v1/user.php');
// 	});
// });

Route::post('/image/upload', [UploadController::class, 'store']);

Route::group(['prefix' => 'users'], function() {
	require base_path('routes/api/v1/user.php');
});

Route::group(['prefix' => 'articles'], function() {
	require base_path('routes/api/v1/article.php');
});

Route::group(['prefix' => 'auth'], function() {
	require base_path('routes/api/v1/auth.php');
});
