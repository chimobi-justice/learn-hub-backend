<?php

namespace App\Http\Controllers\Api\v1\User;

use App\Models\User;
use App\Http\Resources\User\UserFollowResource;
use App\Http\Resources\PaginationResource;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GetUsersToFollowController extends Controller
{
    public function followUsers(Request $request) {
        $limit = $request->query("limit", 15);
        // Get users excluding the authenticated user and order by the number of articles and threads
        $getUsers = User::with(['articles', 'threads'])
            ->where('id', '!=', auth()->id()) // Exclude authenticated user
            ->orderByRaw('(SELECT COUNT(*) FROM articles WHERE user_id = users.id) + (SELECT COUNT(*) FROM threads WHERE user_id = users.id) DESC')
            ->paginate($limit);
        
        return ResponseHelper::success(
            message: "success", 
            data: [
                "users" => UserFollowResource::collection($getUsers),
                "pagination" => PaginationResource::make($getUsers)
            ],
        );
    }

    public function getThreeUsers() {
        $getUsers = User::with(['articles', 'threads'])->get()->sortByDesc(function($user) {
            return $user->articles->count() + $user->threads->count();
        });

        if (auth()->user()) {
            $users = $getUsers->filter(function($user) {
                return $user->id !== auth()->id();
            })->take(3);
        } else {
            $users = $getUsers->take(3);
        }

        return ResponseHelper::success(
            message: "success", 
            data:  UserFollowResource::collection($users)
        );
    }
}
