<?php

namespace App\Models;

use App\Models\User;
use App\Models\ThreadComment;
use App\Models\ThreadLike;
use App\Trait\HandlesSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany; 
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

/**
 * @OA\Schema(
 *  title="Thread",
 *  description="Thread model",
 *  @OA\Xml(
 *    name="Thread",
 *  )
 * )
*/
class Thread extends Model
{
    use HasFactory, HasUuids, Sluggable, HandlesSlug;

    protected $fillable = [
        'title',
        'slug',
        'content'
    ];


     /**
     *  @OA\Property(
     *    title="Title",
     *    description="Title of the Thread",
     *    format="string",
     *    example="About Reactjs and TypeScript"
     *  )
    */
    private $title;

    /**
     *  @OA\Property(
     *    title="Content",
     *    description="Content of the Thread",
     *    format="string",
     *    example="Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit... 
     *              There is no one who loves pain itself, who seeks after it and wants to have it, simply because it is pain..."
     *  )
    */
    private $content;


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
        'threadComments.user', 
        'threadComments.replies.user',
        'threadLikes'
    ];

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    } 

    public function threadLikeBy(User $user) {
        return $this->threadLikes->contains('user_id', $user->id);
    }

    public function threadComments(): HasMany {
        return $this->hasMany(ThreadComment::class)->whereNull('parent_id')->latest();
    }

    public function threadLikes(): HasMany {
        return $this->hasMany(ThreadLike::class);
    }
}
