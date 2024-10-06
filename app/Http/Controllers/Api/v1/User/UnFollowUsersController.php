<?php

namespace App\Http\Controllers\Api\v1\User;

use App\Models\User;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UnFollowUsersController extends Controller
{
    public function unfollow(Request $request, User $user) {
        try {
            $follower = auth()->user();

            $follower->followings()->detach($user);
    
            return ResponseHelper::success(
                message: "You unfollowed this author"
            );
        } catch (ModelNotFoundException $th) {
            return ResponseHelper::error(
                message: "Resource not found",
                statusCode: 404
            );
        }
    }
}
