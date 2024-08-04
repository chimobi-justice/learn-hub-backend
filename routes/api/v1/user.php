<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\User\UserController;
use App\Http\Controllers\Api\v1\User\AvatarController;
use App\Http\Controllers\Api\v1\User\PasswordController;
use App\Http\Controllers\Api\v1\User\EditProfileController;
use App\Http\Controllers\Api\v1\User\DeleteProfileController;

Route::group(['middleware' => 'auth:api'], function() {
    Route::get('/me', [UserController::class, 'index']);
    Route::patch('/accounts/upload-avatar', [AvatarController::class, 'store']);
    Route::patch('/accounts/update-profile', [EditProfileController::class, 'store']);
    Route::patch('/accounts/update-password', [PasswordController::class, 'store']);
    Route::delete('/accounts/delete', [DeleteProfileController::class, 'destroy']);
});
