<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\Image\UploadController;
use App\Http\Controllers\Api\v1\Auth\LoginController;
use App\Http\Controllers\Api\v1\Auth\LogoutController;
use App\Http\Controllers\Api\v1\Auth\RegisterController;
use App\Http\Controllers\Api\v1\User\UserController;
use App\Http\Controllers\Api\v1\User\AvatarController;
use App\Http\Controllers\Api\v1\User\PasswordController;
use App\Http\Controllers\Api\v1\User\EditProfileController;
use App\Http\Controllers\Api\v1\User\DeleteProfileController;

Route::group(['middleware' => 'auth:api'], function() {
	Route::group(['prefix' => 'users'], function() {
		Route::get('/me', [UserController::class, 'index']);
		Route::patch('/accounts/upload-avatar', [AvatarController::class, 'store']);
		Route::patch('/accounts/update-profile', [EditProfileController::class, 'store']);
		Route::patch('/accounts/update-password', [PasswordController::class, 'store']);
		Route::delete('/accounts/delete', [DeleteProfileController::class, 'destroy']);
	});

	Route::post('/image/upload', [UploadController::class, 'store']);
});

Route::group(['prefix' => 'auth'], function() {
	Route::post('/register', [RegisterController::class, 'register']);
	Route::post('/login', [LoginController::class, 'login']);
	Route::post('/logout', [LogoutController::class, 'logout'])->middleware('auth:api');
});
