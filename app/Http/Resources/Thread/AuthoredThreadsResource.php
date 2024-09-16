<?php

namespace App\Http\Resources\Thread;

use Illuminate\Http\Request;
use App\Http\Resources\DateTimeResource;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *  title="ArticleResource",
 *  description="Article Resource",
 *  @OA\Xml(
 *   name="ArticleResource"
 *  )
 * )
*/
class AuthoredThreadsResource extends JsonResource
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
     *   property="can_edit_delete",
     *   type="string",
     *   description="if it belongs to the creator default to true else return false",
     *   example="true"
     * )
     * @OA\Property(
     *   property="created_at",
     *   ref="#/components/schemas/DateTimeResource"
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
            'can_edit_delete' => $isOwner,
            'created_at' => DateTimeResource::make($this->created_at),
        ];
    }
}
