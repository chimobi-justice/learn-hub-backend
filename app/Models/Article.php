<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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
    use HasFactory, HasUuids, Sluggable;

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
                'source' => 'title'
            ]
        ];
    }

    protected $with = ['user'];

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    } 
}
