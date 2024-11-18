<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Social extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = ['user_id', 'platform', 'link'];

    protected $with = ['user' ];

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }
}
