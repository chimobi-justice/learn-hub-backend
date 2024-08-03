<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\User\UserController;
use App\Http\Controllers\Api\v1\User\PasswordController;
use App\Http\Controllers\Api\v1\User\EditProfileController;
use App\Http\Controllers\Api\v1\User\DeleteProfileController;

Route::group(['middleware' => 'auth:api'], function() {
    Route::get('/me', [UserController::class, 'index']);
    Route::post('/settings/accounts/update-profile', [EditProfileController::class, 'store']);
    Route::post('/settings/accounts/update-password', [PasswordController::class, 'store']);
    Route::delete('/settings/accounts/delete', [DeleteProfileController::class, 'destroy']);
});
