<?php

namespace App\Http\Controllers\Api\V1\Articles;

use App\Models\Article;
use App\Helpers\ResponseHelper;
use App\Http\Resources\Article\ArticleShortResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PinnedArticlesController extends Controller
{
    public function pinnedArticles() {                       
        $articles = Article::withCount('articleLikes')
                      ->orderBy('article_likes_count', 'desc')
                      ->limit(3)
                      ->get();

        return ResponseHelper::success(
            message: "success", 
            data: ArticleShortResource::collection($articles),
        );
    }
}
