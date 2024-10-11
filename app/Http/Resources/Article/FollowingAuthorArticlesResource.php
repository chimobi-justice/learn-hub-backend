<?php

namespace App\Http\Resources\Article;

use App\Helpers\EstimatedReadTime;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FollowingAuthorArticlesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $user = auth()->user();

        return [
            'id' => $this->id,
            'title' => $this->title,
            'content' => $this->content,
            'thumbnail' => $this->thumbnail,
            'slug' => $this->slug,
            'read_time' => EstimatedReadTime::readTime($this->content),
            'is_saved' => $user ? $user->savedArticles()->where('article_id', $this->id)->exists() : false,
            'is_following' => $user ? $user->follows($this->user) : false,
            'author' => [
                'id' => $this->user->id,
                'fullname' => $this->user->fullname,
                'username' => $this->user->username,
                'avatar' => $this->user->avatar,
            ]
        ];
    }
}
