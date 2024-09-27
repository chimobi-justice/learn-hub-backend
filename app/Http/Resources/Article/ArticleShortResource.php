<?php

namespace App\Http\Resources\Article;

use App\Http\Resources\DateTimeResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticleShortResource extends JsonResource
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
            'title' => $this->title,
            'slug' => $this->slug,
            'thumbnail' => $this->thumbnail,
            'content' => $this->content,
            'created_at' => DateTimeResource::make($this->created_at),
        ];
    }
}
