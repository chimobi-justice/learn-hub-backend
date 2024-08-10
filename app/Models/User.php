<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Article;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * @OA\Schema(
 *  title="User",
 *  description="User model",
 *  @OA\Xml(
 *    name="user",
 *  )
 * )
*/
class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable, Sluggable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'fullname',
        'email',
        'password',
        'username',
        'twitter',
        'avatar',
        'gitHub',
        'website',
        'profile_headlines',
        'bio',
        'state',
        'country'
    ];

    /**
     *  @OA\Property(
     *    title="Full Name",
     *    description="Full Name of the User",
     *    format="string",
     *    example="justice Owens"
     *  )
    */
    private $fullname;

    /**
     *  @OA\Property(
     *    title="Email",
     *    description="Email of the User",
     *    format="string",
     *    example="justice@example.com"
     *  )
    */
    private $email;

    /**
     *  @OA\Property(
     *    title="Password",
     *    description="Password of the User",
     *    format="string",
     *    example="secret"
     *  )
    */
    private $password;

    /**
     *  @OA\Property(
     *    title="Username",
     *    description="Username of the User",
     *    format="string",
     *    example="justice-dev"
     *  )
    */
    private $username;

    /**
     *  @OA\Property(
     *    title="Twitter",
     *    description="twitter handle of the User",
     *    format="string",
     *    example="@justice-dev"
     *  )
    */
    private $twitter;

    /**
     *  @OA\Property(
     *    title="Avatar",
     *    description="thumbnail of the User",
     *    format="string",
     *    example="thumbnail/lorem/avatar"
     *  )
    */
    private $avatar;

    /**
     *  @OA\Property(
     *    title="GitHub",
     *    description="GitHub of the User",
     *    format="string",
     *    example="github.com/justice-dev"
     *  )
    */
    private $gitHub;

    /**
     *  @OA\Property(
     *    title="Website",
     *    description="Website of the User",
     *    format="string",
     *    example="https://justice-chimobi.vercel.app"
     *  )
    */
    private $website;

    /**
     *  @OA\Property(
     *    title="Profile_headlines",
     *    description="Profile headlines of the User",
     *    format="string",
     *    example="Frontend Developer || React || Laravel"
     *  )
    */
    private $profile_headlines;

    /**
     *  @OA\Property(
     *    title="Bio",
     *    description="Bio of the User",
     *    format="string",
     *    example="about the user short bio.."
     *  )
    */
    private $bio;

    /**
     *  @OA\Property(
     *    title="State",
     *    description="State of the User",
     *    format="string",
     *    example="Ebonyi"
     *  )
    */
    private $state;

    /**
     *  @OA\Property(
     *    title="Country",
     *    description="Country of the User",
     *    format="string",
     *    example="Nigeria"
     *  )
    */
    private $country;

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function sluggable(): array {
        return [
            'username' => [
                'source' => 'fullname'
            ]
        ];
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function articles(): HasMany {
        return $this->hasMany(Article::class);
    }    
}
