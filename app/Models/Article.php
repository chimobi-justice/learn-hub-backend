<?php

namespace App\Models;

use App\Models\User;
use App\Models\ArticleLike;
use App\Models\ArticleComment;
use App\Trait\HandlesSlug;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany; 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

/**
 * @OA\Schema(
 *  title="Article",
 *  description="Article model",
 *  @OA\Xml(
 *    name="article",
 *  )
 * )
*/
class Article extends Model
{
    use HasFactory, HasUuids, Sluggable, HandlesSlug;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'thumbnail'
    ];

    /**
     *  @OA\Property(
     *    title="Title",
     *    description="Title of the Article",
     *    format="string",
     *    example="About Reactjs and TypeScript"
     *  )
    */
    private $title;

     /**
     *  @OA\Property(
     *    title="Slug",
     *    description="Title slug of the Article",
     *    format="string",
     *    example="about-reactjs-and-typeScript"
     *  )
    */
    private $slug;

    /**
     *  @OA\Property(
     *    title="Content",
     *    description="Content of the article",
     *    format="string",
     *    example="Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit... 
     *              There is no one who loves pain itself, who seeks after it and wants to have it, simply because it is pain..."
     *  )
    */
    private $content;

    /**
     *  @OA\Property(
     *    title="thumbnail",
     *    description="thumbnail of the Article",
     *    format="string",
     *    example="https::cloudinary.com/thumbnail/lorem/thumbnail"
     *  )
    */
    private $thumbnail;


      /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    
    public function sluggable(): array {
        return [
            'slug' => [
                'source' => 'title',
                'onUpdate' => true
            ]
        ];
    }

    protected $with = [
        'user', 
        'articleComments.user',
        'articleComments.replies.user',
        'articleLikes'
    ];

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    } 

    public function articleLikeBy(User $user) {
        return $this->articleLikes->contains('user_id', $user->id);
    }

    public function articleComments(): HasMany {
        return $this->hasMany(ArticleComment::class)->whereNull('parent_id')->latest();
    }

    public function articleLikes(): HasMany {
        return $this->hasMany(ArticleLike::class);
    }
}