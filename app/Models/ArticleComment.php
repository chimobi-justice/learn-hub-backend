<?php

namespace App\Models;

use App\Models\User;
use App\Models\Article;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany; 
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class ArticleComment extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'comment',
        'user_id',
        'parent_id'
    ];

    public function article(): BelongsTo {
        return $this->belongsTo(Article::class);
    } 

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    } 

    public function replies(): HasMany {
        return $this->hasMany(ArticleComment::class, 'parent_id')
            ->with('replies.user')
            ->latest();
    }
}
