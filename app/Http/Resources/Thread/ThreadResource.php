<?php

namespace App\Http\Resources\Thread;

use Illuminate\Http\Request;
use App\Http\Resources\DateTimeResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\User\UserForArticleResource;

/**
 * @OA\Schema(
 *  title="ThreadResource",
 *  description="Thread Resource",
 *  @OA\Xml(
 *   name="ThreadResource"
 *  )
 * )
*/
class ThreadResource extends JsonResource
{
    /**
     * @OA\Property(
     *   property="id",
     *   type="string",
     *   description="Course ID",
     *   example="9d04e3b2-7e14-472e-8095-7f7f9f0c943f"
     * )
     * @OA\Property(
     *   property="title",
     *   type="string",
     *   description="Article title",
     *   example="Article intro"
     * )
     * @OA\Property(
     *   property="slug",
     *   type="string",
     *   description="Article slug title",
     *   example="article-intro"
     * )
     * @OA\Property(
     *   property="content",
     *   type="string",
     *   description="Article content",
     *   example="About my article content."
     * )
     * @OA\Property(
     *   property="created_at",
     *   ref="#/components/schemas/DateTimeResource"
     * )
     * @OA\Property(
     *   property="author",
     *   ref="#/components/schemas/UserForArticleResource"
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
        $user = auth()->user();

        $isOwner = $user ? $user->id === $this->user_id : false;

        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'content' => $this->content,
            'isOwner' => $isOwner,
            'created_at' => DateTimeResource::make($this->created_at),
            'author' => new UserForArticleResource($this->whenLoaded('user'))
        ];
    }
}
