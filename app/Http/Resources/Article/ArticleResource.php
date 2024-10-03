<?php

namespace App\Http\Resources\Article;

use Illuminate\Http\Request;
use App\Http\Resources\DateTimeResource;
use App\Helpers\EstimatedReadTime;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\UserShortResource;
use App\Http\Resources\Article\ArticleCommentResource;
use Illuminate\Support\Number;

/**
 * @OA\Schema(
 *  title="ArticleResource",
 *  description="Article Resource",
 *  @OA\Xml(
 *   name="ArticleResource"
 *  )
 * )
*/
class ArticleResource extends JsonResource
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
     *   property="thumbnail",
     *   type="string",
     *   description="URL of the article thumbnail",
     *   example="https://res.cloudinary.com/dbx3dhfkt/image/upload/v1672045944/estudy/pictures/image-5a9482cd3-a97e-4627-dbc3-9cb53797e40a.png"
     * 
     * )
     * @OA\Property(
     *   property="read_time",
     *   type="string",
     *   description="Article content time read",
     *   example="25 mins read"
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

        $isSingleArticle = $request->route('article') !== null;

        $data = [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'content' => $this->content,
            'thumbnail' => $this->thumbnail,
            'isOwner' => $isOwner,
            'read_time' => EstimatedReadTime::readTime($this->content),
            'is_saved' => $user ? $user->savedArticles()->where('article_id', $this->id)->exists() : false,
            'author' => new UserShortResource($this->whenLoaded('user')),
            'article_like_counts' => Number::abbreviate($this->articleLikes()->count()),
            'article_comment_counts' => Number::abbreviate($this->articleComments()->count()),
            'user_liked_article' => $this->when(auth()->user(), function() {
               return $this->articleLikeBy(auth()->user());
            }),
            'created_at' => DateTimeResource::make($this->created_at),
        ];

        // If it's a single resource (not a collection), add the actual comments
        if ($isSingleArticle) {
            $data['article_comments'] = ArticleCommentResource::collection($this->whenLoaded('articleComments'));
        }

        return $data;
    }
}
