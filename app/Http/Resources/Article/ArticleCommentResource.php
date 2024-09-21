<?php

namespace App\Http\Resources\Article;

use Illuminate\Http\Request;
use App\Http\Resources\DateTimeResource;
use App\Http\Resources\UserShortResource;
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
        return [
            'id' => $this->id,
            'article_id' => $this->article_id,
            'comment' => $this->comment,
            'created_at' => DateTimeResource::make($this->created_at),
            'user' => new UserShortResource($this->whenLoaded('user')),
        ];
    }
}
