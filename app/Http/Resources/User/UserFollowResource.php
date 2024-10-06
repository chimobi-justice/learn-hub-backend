<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserFollowResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $authUser = auth()->user();
        $user = $this->resource;

        return [
            'id' => $this->id,
            'fullname' => $this->fullname,
            'username' => $this->username,
            'avatar' => $this->avatar,
            'bio' => $this->bio,
            // Check if there's an authenticated user, then return true or false for following status
            'is_following' => $authUser ? $authUser->follows($user) : false,
        ];
    }
}
