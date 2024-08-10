<?php

namespace App\Http\Resources\Article;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\User\UserForArticleResource;

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
     *   example="20"
     * )
     * @OA\Property(
     *   property="title",
     *   type="string",
     *   description="Article title",
     *   example="Article intro"
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
     *   property="author",
     *   ref="#/components/schemas/UserForArticleResource"
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
        return [
            'id' => $this->id,
            'title' => $this->title,
            'content' => $this->content,
            'thumbnail' => $this->thumbnail,
            'author' => new UserForArticleResource($this->whenLoaded('user'))
        ];
    }
}
