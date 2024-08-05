<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\Image\UploadController;

Route::prefix('auth')->group(
	base_path('routes/api/v1/auth.php'),
);

Route::prefix('users')->group(
	base_path('routes/api/v1/user.php'),
);

Route::post('/image/upload', [UploadController::class, 'store'])->middleware('auth:api');