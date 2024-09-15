<?php

namespace App\Http\Resources\Article;

use Illuminate\Http\Request;
use App\Http\Resources\DateTimeResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\User\UserForArticleResource;

class AuthoredArticleResource extends JsonResource
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
            'title' => $this->title,
            'slug' => $this->slug,
            'content' => $this->content,
            'thumbnail' => $this->thumbnail,
            'can_edit_delete' => $isOwner,
            'created_at' => DateTimeResource::make($this->created_at),
        ];
    }
}
