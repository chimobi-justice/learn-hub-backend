<?php

namespace App\Http\Controllers\Api\v1\User;

use App\Http\Resources\User\UserFollowResource;
use App\Helpers\ResponseHelper;
use App\Http\Resources\PaginationResource;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Exception;

class GetFollowUsers extends Controller
{
    public function following() {
        return $this->getFollowData("followings", "Following arthors return successfully");
    }

    public function followers() {
        return $this->getFollowData("followers", "Followers return successfully");
    }

    private function getFollowData(string $relation, string $successMessage) {
        try {
            $user = auth()->user();
            $limit = request()->query('limit', 15);

            $data = $user->$relation()->latest()->paginate($limit);

            return ResponseHelper::success(
                message: $successMessage,
                data: [
                    "$relation" => UserFollowResource::collection($data),
                    "pagination" => PaginationResource::make($data)
                ]
            );
        } catch (Exception $e) {
            return ResponseHelper::error(
                message: "Something went wrong! please try again",
                statusCode: 500
            );
        }
    }
}
