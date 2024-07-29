<?php

namespace App\Http\Controllers\Api\v1\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\User\UserResource;

class UserController extends Controller
{
    public function user(Request $request) {
        return new UserResource($request->user());
    }
}
