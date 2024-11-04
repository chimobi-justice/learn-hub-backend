<?php

namespace App\Http\Resources\Thread;

use Illuminate\Http\Request;
use App\Http\Resources\DateTimeResource;
use App\Http\Resources\UserShortResource;
use App\Http\Resources\Thread\ThreadUserResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Number;

class ThreadCommentResource extends JsonResource
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
            'thread_id' => $this->thread_id,
            'comment' => $this->comment,
            'user' => new ThreadUserResource($this->whenLoaded('user')),
            'created_at' => DateTimeResource::make($this->created_at),
            'replies_count' => $this->replies->count(),
            'replies' => ThreadCommentResource::collection($this->whenLoaded('replies')),
        ];
    }
}
