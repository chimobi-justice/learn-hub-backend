<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Number;

/**
 * @OA\Schema(
 *  title="UserShortResource",
 *  description="User article Resource",
 *  @OA\Xml(
 *   name="UserShortResource"
 *  )
 * )
*/
class UserShortResource extends JsonResource
{
    /**
     * @OA\Property(
     *   property="id",
     *   type="string",
     *   description="Id",
     *   example="9d04e3b2-7e14-472e-8095-7f7f9f0c943f"
     * )
     * @OA\Property(
     *   property="fullname",
     *   type="string",
     *   description="Full name",
     *   example="Justice Chimobi"
     * )
     *@OA\Property(
     *   property="username",
     *   type="string",
     *   description="Username",
     *   example="justice-chimobi"
     * )
     * @OA\Property(
     *   property="avatar",
     *   type="string",
     *   description="Course name",
     *   example="https://res.cloudinary.com/estudy/image/upload/v1705789451/yofikr4gyecw04sp5ial.jpg"
     * )
     * * @OA\Property(
     *   property="profile_headlines",
     *   type="string",
     *   description="profile_headlines",
     *   example="Frontend Developer || Full Stack"
     * )
     */
    private $data;


    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $showAllAurthorDetails = $request->route('article') !== null;

        $authUser = auth()->user();
        $user = $this->resource;

        $data = [
            'id' => $this->id,
            'fullname' => $this->fullname,
            'username' => $this->username,
            'avatar' => $this->avatar,
            'profile_headlines' => $this->profile_headlines,
            'followers' => Number::abbreviate($this->followers()->count()),
            'followings' => Number::abbreviate($this->followings()->count()),
            'is_following' => $authUser ? $authUser->follows($user) : false,
        ];


        if ($showAllAurthorDetails) {
            $data['info_details'] = [
                'bio' => $this->bio,
                'twitter' => $this->twitter,
                'gitHub' => $this->gitHub,
                'website' => $this->website,
            ];
        }

        return $data;
    }
}
