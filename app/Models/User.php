<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * @OA\Schema(
 *  title="User",
 *  description="User model NB: (only mentor are allowed to add there bio & occupation fields, because bio, occupation won't be returned to student)",
 *  @OA\Xml(
 *    name="user",
 *  )
 * )
*/
class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'fullname',
        'email',
        'password',
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

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
