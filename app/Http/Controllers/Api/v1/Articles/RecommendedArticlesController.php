<?php

namespace App\Http\Controllers\Api\V1\Articles;

use App\Models\Article;
use App\Helpers\ResponseHelper;
use App\Http\Resources\Article\ArticleResource;
use App\Http\Resources\PaginationResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RecommendedArticlesController extends Controller
{
    public function getRecommentedArticles(Request $request) { 
        $limit = $request->query('limit', 20);

        $articles = Article::inRandomOrder()
                      ->paginate($limit);
        
        return ResponseHelper::success(
            message: "success", 
            data: [
                "articles" => ArticleResource::collection($articles),
                "pagination" => PaginationResource::make($articles)
            ]
        );
    }
}
