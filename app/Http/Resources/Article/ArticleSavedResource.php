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
                'fullname' => $this->article->user->fullname,
                'username' => $this->article->user->username,
                'avatar' => $this->article->user->avatar,
            ],
            'likes_count' => $this->article->articleLikes()->count(),
            'comments_count' => $this->article->articleComments()->count(),
        ];
    }
}
