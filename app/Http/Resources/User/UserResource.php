<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'fullname' => $this->fullname,
            'email' => $this->email,
            'username' => $this->username,
            'twitter' => $this->twitter,
            'avatar' => $this->avatar,
            'gitHub' => $this->gitHub,
            'website' => $this->website,
            'headlines' => $this->headlines,
            'state' => $this->state,
            'country' => $this->country,
            'bio' => $this->bio, 
        ];
    }
}
