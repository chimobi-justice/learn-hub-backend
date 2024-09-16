<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *  title="UserForArticleResource",
 *  description="User article Resource",
 *  @OA\Xml(
 *   name="UserForArticleResource"
 *  )
 * )
*/
class UserForArticleResource extends JsonResource
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
        return [
            'id' => $this->id,
            'fullname' => $this->fullname,
            'username' => $this->username,
            'avatar' => $this->avatar,
            'profile_headlines' => $this->profile_headlines,
        ];
    }
}