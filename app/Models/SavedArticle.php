<?php

namespace App\Models;

use App\Models\User;
use App\Models\Article;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class SavedArticle extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'article_id'
    ];

    public function article(): BelongsTo {
        return $this->belongsTo(Article::class);
    } 
}
