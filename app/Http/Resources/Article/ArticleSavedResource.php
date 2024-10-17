<?php

namespace App\Http\Resources\Article;

use App\Helpers\EstimatedReadTime;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticleSavedResource extends JsonResource
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
            'id' => $this->article->id,
            'title' => $this->article->title,
            'content' => $this->article->content,
            'thumbnail' => $this->article->thumbnail,
            'is_saved' => $user ? $user->savedArticles()->where('article_id', $this->article->id)->exists() : false,
            'slug' => $this->article->slug,
            'read_time' => EstimatedReadTime::readTime($this->article->content),
            'author' => [
                'id' => $this->article->user->id,
                'fullname' => $this->article->user->fullname,
                'username' => $this->article->user->username,
                'avatar' => $this->article->user->avatar,
                'is_following' => $user ? $user->follows($this->article->user) : false,
            ],
            'likes_count' => $this->article->articleLikes()->count(),
            'comments_count' => $this->article->articleComments()->count(),
        ];
    }
}
