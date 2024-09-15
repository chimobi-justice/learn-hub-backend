<?php

namespace App\Http\Controllers\Api\v1\Articles;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\Article\AuthoredArticleResource;

class AuthoredArticlesController extends Controller
{
    public function getAuthoredArticles(Request $request) {
        $limit = $request->query('limit', 10);

        $articles = auth()->user()->articles()->paginate($limit);
        
        return ResponseHelper::success(
            message: "success", 
            data: [
                "articles" => AuthoredArticleResource::collection($articles),
                "pagination" => [
                    "current_page" => $articles->currentPage(),
                    "last_page" => $articles->lastPage(),
                    "next_page_url" => $articles->nextPageUrl(),
                    "total" => $articles->total()
                ],
            ],
        );
    }
}
