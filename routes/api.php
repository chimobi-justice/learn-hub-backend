<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\v1\User\UserController;
use App\Http\Controllers\Api\v1\Auth\RegisterController;

Route::get('/user', [UserController::class, 'user'])->middleware('auth:api');

Route::prefix('auth')->as('auth:')->group(
	base_path('routes/api/v1/auth.php'),
);
