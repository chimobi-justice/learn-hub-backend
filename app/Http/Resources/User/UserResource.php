<?php

namespace App\Http\Resources\User;

use App\Http\Resources\User\SocialResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Number;

class UserResource extends JsonResource
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
            'email' => $this->email,
            'username' => $this->username,
            'avatar' => $this->avatar,
            'profile_headlines' => $this->profile_headlines,
            'state' => $this->state,
            'country' => $this->country,
            'bio' => $this->bio, 
            'followers' => Number::abbreviate($this->followers()->count()),
            'followings' => Number::abbreviate($this->followings()->count()),
            'is_following' => $authUser ? $authUser->follows($user) : false,
            'socials' => SocialResource::collection($this->whenLoaded('socials'))
        ];
    }
}
