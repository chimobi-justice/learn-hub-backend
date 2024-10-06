<?php

namespace App\Http\Controllers\Api\v1\User;

use App\Models\User;
use App\Http\Resources\User\UserFollowResource;
use App\Http\Resources\PaginationResource;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class FollowUsersController extends Controller
{
    public function follow(Request $request, User $user) {
        try {
            $follower = auth()->user();

            if ($follower->follows($user)) {
                return ResponseHelper::success(
                    message: "You already followed this author"
                );
            }

            $follower->followings()->attach($user);

            return ResponseHelper::success(
                message: "You followed this author"
            );
        } catch (ModelNotFoundException $th) {
            return ResponseHelper::error(
                message: "Resource not found",
                statusCode: 404
            );
        }
    }
}
