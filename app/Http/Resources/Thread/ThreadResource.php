<?php

namespace App\Http\Resources\Thread;

use Illuminate\Http\Request;
use App\Http\Resources\DateTimeResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\UserShortResource;
use App\Http\Resources\Thread\ThreadCommentResource;
use Illuminate\Support\Number;

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
     *   property="thread_comment_counts",
     *   type="number",
     *   description="Number of Thread comments",
     *   example="67"
     * )
     * @OA\Property(
     *   property="thread_like_counts",
     *   type="number",
     *   description="Number of Thread likes",
     *   example="47"
     * )
     * @OA\Property(
     *   property="user_liked_thread",
     *   type="boolean",
     *   description="if currently authenticated user like a thread already",
     *   example="false"
     * )
     * @OA\Property(
     *   property="created_at",
     *   ref="#/components/schemas/DateTimeResource"
     * )
     * @OA\Property(
     *   property="author",
     *   ref="#/components/schemas/UserShortResource"
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

        $isSingleThread = $request->route('thread') !== null;

        $data = [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'content' => $this->content,
            'isOwner' => $isOwner,
            'author' => new UserShortResource($this->whenLoaded('user')),
            'thread_comment_counts' => Number::abbreviate($this->threadComments()->count()),
            'thread_like_counts' => Number::abbreviate($this->threadLikes()->count()),
            'user_liked_thread' => $this->when(auth()->user(), function() {
               return $this->threadLikeBy(auth()->user());
            }),
            'created_at' => DateTimeResource::make($this->created_at),
        ];

        // If it's a single resource (not a collection), add the actual comments
        if ($isSingleThread) {
            $data['thread_comments'] = ThreadCommentResource::collection($this->whenLoaded('threadComments'));
        }

        return $data;
    }
}
