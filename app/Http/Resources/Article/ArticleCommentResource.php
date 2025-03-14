<?php

namespace App\Http\Resources\Article;

use Illuminate\Http\Request;
use App\Http\Resources\DateTimeResource;
use App\Http\Resources\Article\ArticleUserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticleCommentResource extends JsonResource
{
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
            'article_id' => $this->article_id,
            'comment' => $this->comment,
            'user' => new ArticleUserResource($this->whenLoaded('user')),
            'isOwner' => $isOwner,
            'created_at' => DateTimeResource::make($this->created_at),
            'replies_count' => $this->replies->count(),
            'replies' => ArticleCommentResource::collection($this->whenLoaded('replies')),
        ];
    }
}
