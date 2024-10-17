<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\User\UserController;
use App\Http\Controllers\Api\v1\User\AvatarController;
use App\Http\Controllers\Api\v1\User\PasswordController;
use App\Http\Controllers\Api\v1\User\EditProfileController;
use App\Http\Controllers\Api\v1\User\DeleteProfileController;
use App\Http\Controllers\Api\v1\User\GetUsersToFollowController;
use App\Http\Controllers\Api\v1\User\FollowUsersController;
use App\Http\Controllers\Api\v1\User\UnFollowUsersController;
use App\Http\Controllers\Api\v1\User\GetFollowingUsersArticlesController;
use App\Http\Controllers\Api\v1\User\GetFollowUsers;

Route::group(['middleware' => 'auth:api'], function() {
	Route::get('/me', [UserController::class, 'index']);
    Route::patch('/accounts/upload-avatar', [AvatarController::class, 'store']);
    Route::patch('/accounts/update-profile', [EditProfileController::class, 'store']);
    Route::patch('/accounts/update-password', [PasswordController::class, 'store']);
    Route::delete('/accounts/delete', [DeleteProfileController::class, 'destroy']);

    Route::get('/my-follow-users/articles', [GetFollowingUsersArticlesController::class, 'getFollowingUsersArticles']);

    Route::get('/followings', [GetFollowUsers::class, 'following']);
    Route::get('/followers', [GetFollowUsers::class, 'followers']);

    Route::post('/{user}/follow', [FollowUsersController::class, 'follow']);
    Route::post('/{user}/unfollow', [UnFollowUsersController::class, 'unfollow']);
});

Route::get('/get-three-users', [GetUsersToFollowController::class, 'getThreeUsers']);
Route::get('/all-users', [GetUsersToFollowController::class, 'followUsers']);
Route::get('/{user:username}', [UserController::class, 'publicUser']);
